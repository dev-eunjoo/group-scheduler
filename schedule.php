<?php
/* Eunjoo Na, 000811369
 * Date: 2020.12.08
 * Description: schedule.php for the group scheduler web application. It is a class to create schedule objects.  
 */

class Schedule implements JsonSerializable
{
    private $id;
    private $date;
    private $title;
    private $text;
    private $username;

    function __construct($id, $date, $title, $text, $username)
    {
        $this->id = (int)$id;
        $this->date = $date;
        $this->title = $title;
        $this->text = $text;
        $this->username = $username;
    }

    function toListItem()
    {
        return "<li>$this->id $this->date $this->title $this->text $this->username </li>";
    }
    /**
     * returns json_encode  
     */
    public function jsonSerialize()
    {
        return  get_object_vars($this);
    }
}
