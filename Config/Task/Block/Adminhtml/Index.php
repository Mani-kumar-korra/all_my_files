<?php
namespace Config\Task\Block\Adminhtml;

use Magento\Config\Model\Config\Source\Yesno;
use Magento\Framework\View\Element\Template;
use Magento\Config\Model\Config\Structure;

class Index extends Template
{
    /**
     * @var Structure
     */
    protected $configStructure;
    protected $matchKey = [];

    public function __construct(
        Structure $configStructure,
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->configStructure = $configStructure;
    }

    public function getConfigDump()
    {
        // Read the configuration dump from config.php
        $configDump = include BP . '/app/etc/config.php';
        return $configDump;
    }

    public function getConfigArray()
    {
        $configDump = $this->getConfigDump();
        return is_array($configDump) ? $configDump : [];
    }

    public function flattenConfigArray($configArray, $parentKey = '', $separator = '/')
    {
        $result = [];
        foreach ($configArray as $key => $value) {
            $newKey = empty($parentKey) ? $key : $parentKey . $separator . $key;
            if (is_array($value)) {
                $result = array_merge($result, $this->flattenConfigArray($value, $newKey, $separator));
            } elseif (in_array($value, ['0', '1'])) {
                // Extract the initial key (the first part before $separator)
                $initialKey = explode($separator, $newKey)[0];

                // Skip rows with 'module' in the parent key
                if ($initialKey !== 'modules') {
                    // Split the $newKey into parts using the separator
                    $keyParts = explode($separator, $newKey);

                    // Remove the first two parts (system and default)
                    $keyParts = array_slice($keyParts, 2);

                    // Rejoin the remaining parts to form the modified key
                    $newKey = implode($separator, $keyParts);

                    $result[] = [
                        'parent_key' => $initialKey,
                        'key' => $newKey,
                        'value' => $value
                    ];
                    $dummy[$newKey] = $this->getCustomElement($newKey, $initialKey, $value);
                }
            }
        }

        // Add this line to display the contents of $this->matchKey


        return $result;
    }

    public function getCustomElement($key, $parent_key, $value)
    {
        // Call getElement with the provided key
        $custom = $this->configStructure->getElement($key);
        $custom = $custom->getData();
        if (isset($custom['source_model'])) {
            // Now, you have the custom element based on the key
            $isTrue = $custom['source_model'] === Yesno::class ? true : false;

            // Debugging: Display the key when the condition is true
            if ($isTrue) {
                $this->matchKey[] = [
                    'key' => $key,
                    'parent_key' => $parent_key,
                    'value' => $value
                ];


            }
            return $isTrue;
        }
        return false;
    }


}
