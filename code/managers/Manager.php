<?php




namespace InsiteApps\Common;

use InsiteApps;

use DateTime;
use DateTimeZone;

/**
 * Class Manager
 * @package InsiteApps\Common
 */
class Manager extends InsiteApps\Common
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
        $oMembers = \Member::get()
            ->leftJoin("Group_Members", "Group_Members.MemberID = Member.ID")
            ->leftJoin("Permission", "Permission.GroupID = Group_Members.GroupID")
            ->filter(["Permission.Code" => 'RECEIVE_NOTIFICATION']);
        return $oMembers;
    }
}
