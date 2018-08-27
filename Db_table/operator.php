<?php
namespace Db_table;
class operator
{
    private $id = null;
    private $name = null;
    private $surname = null;
    private $user_name = null;
    private $password = null;
    private $created_on = null;
    private $updated_on = null;
    
    public function __construct($id, $name, $surname, $user_name, $password, $created_on, $updated_on){
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->user_name = $user_name;
        $this->password = $password;
        $this->created_on = $created_on;
        $this->updated_on = $updated_on;
        
    }
    
    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @return mixed
     */
    public function getUser_name()
    {
        return $this->user_name;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @return mixed
     */
    public function getCreated_on()
    {
        return $this->created_on;
    }

    /**
     * @return mixed
     */
    public function getUpdated_on()
    {
        return $this->updated_on;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @param mixed $user_name
     */
    public function setUser_name($user_name)
    {
        $this->user_name = $user_name;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $created_on
     */
    public function setCreated_on($created_on)
    {
        $this->created_on = $created_on;
    }

    /**
     * @param mixed $updated_on
     */
    public function setUpdated_on($updated_on)
    {
        $this->updated_on = $updated_on;
    }


    
    
}