<?php
/**
 *
 * Copyright (c) 2017 Insite Apps - http://www.insiteapps.co.za
 * All rights reserved.
 * @package insiteapps
 * @author Patrick Chitovoro  <patrick@insiteapps.co.za>
 * Redistribution and use in source and binary forms, with or without modification, are NOT permitted at all.
 * There is no freedom to share or change it this file.
 *
 *
 */

namespace InsiteApps\Common;

use InsiteApps;
use SilverStripe\Security\Member;
use InsiteApps\Common;

/**
 * Class Manager
 * @package InsiteApps\Common
 */
class Manager extends Common
{

    /**
     * @param int $x
     * @param int $max
     * @return array
     */
    public function getNumericValues($x = 0, $max = 4)
    {
        $arrValues = array();
        for ($i = $x; $i <= $max; $i++) {
            $arrValues[$i] = $i;
        }
        return $arrValues;
    }

    /**
     * Get list of all members you have the "Full administrative right" permission
     * @return \DataList
     */
    public static function get_admin_list()
    {
        $oMembers = Member::get()
            ->leftJoin("Group_Members", "Group_Members.MemberID = Member.ID")
            ->leftJoin("Permission", "Permission.GroupID = Group_Members.GroupID")
            ->filter(["Permission.Code" => 'RECEIVE_NOTIFICATION']);
        return $oMembers;
    }
}
