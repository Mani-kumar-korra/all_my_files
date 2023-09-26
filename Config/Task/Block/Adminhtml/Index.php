<?php
namespace Config\Task\Block\Adminhtml;

use Magento\Framework\View\Element\Template;

class index extends Template
{
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

    public function flattenConfigArray($configArray, $parentKey = '', $separator = ': ')
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
                    $result[] = [
                        'parent_key' => $initialKey,
                        'key' => $newKey,
                        'value' => $value,
                    ];
                }
            }
        }
        return $result;
    }

}
