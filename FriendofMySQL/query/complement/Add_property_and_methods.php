<?php namespace add_property_and_methods;

#In case you want to add more methods and properties to the class
class add_property_and_methods
{

    /*--------------------------------------------------------------------------------------------------*/
                                      #BOX PROPERTY AND METHODS
    /*--------------------------------------------------------------------------------------------------*/


    #This method can be called with self:: from query.php
    public function My_method($connection,$data,$sql)
    {
        #Insert Animals
        if (!$connection->query($sql)) {
            $this->callback =  false;
        }
        $this->callback = true;
    }


    /*--------------------------------------------------------------------------------------------------*/
                                      #END BOX PROPERTY AND METHODS
    /*--------------------------------------------------------------------------------------------------*/


}

?>