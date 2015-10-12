<?php
namespace Craft;

/**
 * MultiDate field plugin
 *
 * @author    Boris Jerenec <boris@studiotandem.si>
 * @copyright Copyright (c) 2015, Boris Jerenec.
 * @license   MIT
 * @version   0.9
 */
class MultidateFieldPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Multidate field');
    }

    function getVersion()
    {
        return '0.9';
    }

    function getDeveloper()
    {
        return 'Boris Jerenec';
    }

    function getDeveloperUrl()
    {
        return 'http://studiotandem.si/en';
    }

    // hook for Import plugin (we expect data as YYYY-MM-DD,YYYY-MM-DD,.... ) and transform it in JSON
    public function registerImportOperation(&$data, $handle)
    {
      // $data = StringHelper::convertToUTF8($data);
      // $data = trim($data);

        // Get field info
        $field = craft()->fields->getFieldByHandle($handle);

        // process it's our field
        if (!is_null($field)) {
          if ($field->type == "MultidateField") {
            $dates = mb_split(',',$data);

            if ((count($dates) == 1) && empty($dates[0]))  {
              $dates = array();
            }
            $datesJson = json_encode($dates);
            $data = array('date' => $datesJson);
          }
        }
        return $data;
    }

}
