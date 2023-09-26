<?php
namespace Config\Task\Ui\Component\Listing;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Serialize\SerializerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Psr\Log\LoggerInterface; // Import the LoggerInterface

class CustomDataProvider extends AbstractDataProvider
{
    protected $configScope;
    protected $serializer;
    protected $logger; // Add the logger property

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ScopeConfigInterface $configScope,
        SerializerInterface $serializer,
        LoggerInterface $logger, // Inject the logger here
        array $meta = [],
        array $data = []
    ) {
        $this->configScope = $configScope;
        $this->serializer = $serializer;
        $this->logger = $logger; // Save the logger as a property
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }
    
    public function getData()
    {
        $configDump = $this->configScope->getValue('/app/etc/config.php'); // Replace with your actual config path

        if ($configDump !== null) {
            $configArray = $this->serializer->unserialize($configDump);

            $result = ['items' => [], 'totalRecords' => 0];

            $separator = ': ';
            
            $processConfig = function ($configArray, $parentKey = '') use (&$result, $separator) {
                foreach ($configArray as $key => $value) {
                    $newKey = empty($parentKey) ? $key : $parentKey . $separator . $key;
                    if (is_array($value)) {
                        $processConfig($value, $newKey);
                    } elseif (in_array($value, ['0', '1'])) {
                        $initialKey = explode($separator, $newKey)[0];
                        if ($initialKey !== 'modules') {
                            $result['items'][] = [
                                'parent_key' => $initialKey,
                                'key' => $newKey,
                                'value' => $value,
                            ];
                            $result['totalRecords']++;
                        }
                    }
                }
            };

            $processConfig($configArray);
            
            // Log a message to indicate that data was successfully retrieved
            $this->logger->info('Data retrieved successfully.');

        } else {
            // Handle the case where $configDump is null, e.g., throw an exception or provide a default value.
            $result = ['items' => [], 'totalRecords' => 0];

            // Log an error message to indicate that data retrieval failed
            $this->logger->error('Data retrieval failed.');

        }

        return $result;
    }
}
