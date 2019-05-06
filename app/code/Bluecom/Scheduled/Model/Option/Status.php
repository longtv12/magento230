<?php
namespace Bluecom\Scheduled\Model\Option;

use Magento\Framework\Data\OptionSourceInterface;

class Status implements OptionSourceInterface
{
	 public function toOptionArray()
    {
        return [['value' => 0, 'label' => __('Disable')],['value' => 1, 'label' => __('Running')]];
    }
}
