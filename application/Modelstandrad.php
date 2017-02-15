
    <?php
    /**
     * Model base class
     */
    class Model {
        
        protected static $tableName = '';
        protected static $primaryKey = '';
        protected $columns;
        
     function __construct() {
      $this->columns = array();
     }
        
        function setColumnValue($column,$value){
            $this->columns[$column] = $value;
        }
        
        function getColumnValue($column){
            return $this->columns[$column];
        }
        /**
         * Save or update the item data in database
         */
        function save(){
            $class = get_called_class();
            $query =  "REPLACE INTO " . static::$tableName . " (" . implode(",", array_keys($this->columns)) . ") VALUES(";
            $keys = array();
            foreach ($this->columns as $key => $value) {
                $keys[":".$key] = $value;
            }
            $query .= implode(",", array_keys($keys)).")";
            $db = Database::getInstance();
            $s = $db->getPreparedStatment($query);
            $s->execute($keys);
        }
        
        /**
         * Delete this item data from database
         */
        function delete(){
            $class = get_called_class();
            $query = "DELETE FROM " . static::$tableName . " WHERE ".static::$primaryKey."=:id LIMIT 1";
            $db = Database::getInstance();
            $s = $db->getPreparedStatment($query);
            $s->execute(array(':id'=>$this->columns[static::$primaryKey]));
        }
        
        /**
         * Create an instance of this Model from the database row
         */
        function createFromDb($column){
            foreach ($column as $key => $value) {
                $this->columns[$key] = $value;
            }
        }
        
        /**
         * Get all items
         * Conditions are combined by logical AND
         * @example getAll(array(name=>'Bond',job=>'artist'),'age DESC',0,25) converts to SELECT * FROM TABLE WHERE name='Bond' AND job='artist' ORDER BY age DESC LIMIT 0,25
         */
        static function getAll($condition=array(),$order=NULL,$startIndex=NULL,$count=NULL){
            $query = "SELECT * FROM " . static::$tableName;
            if(!empty($condition)){
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:".$key." AND ";
                }
            }
            $query = rtrim($query,' AND ');
            if($order){
                $query .= " ORDER BY " . $order;
            }
            if($startIndex !== NULL){
                $query .= " LIMIT " . $startIndex;
                if($count){
                    $query .= "," . $count;
                }
            }
            return self::get($query,$condition);
        }
        
        /**
         * Pass a custom query and condition
         * @example get('SELECT * FROM TABLE WHERE name=:user OR age<:age',array(name=>'Bond',age=>25))
         */
        static function get($query,$condition=array()){
            $db = Database::getInstance();
            $s = $db->getPreparedStatment($query);
            foreach ($condition as $key => $value) {
                $condition[':'.$key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $result = $s->fetchAll(PDO::FETCH_ASSOC);
            $collection = array();
            $className = get_called_class();
            foreach($result as $row){
                $item = new $className();
                $item->createFromDb($row);
                array_push($collection,$item);
            }
            return $collection;
        }
        
        /**
         * Get a single item
         */
        static function getOne($condition=array(),$order=NULL,$startIndex=NULL){
            $query = "SELECT * FROM " . static::$tableName;
            if(!empty($condition)){
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:".$key." AND ";
                }
            }
            $query = rtrim($query,' AND ');
            if($order){
                $query .= " ORDER BY " . $order;
            }
            if($startIndex !== NULL){
                $query .= " LIMIT " . $startIndex . ",1";
            }
            $db = Database::getInstance();
            $s = $db->getPreparedStatment($query);
            foreach ($condition as $key => $value) {
                $condition[':'.$key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $row = $s->fetch(PDO::FETCH_ASSOC);
            $className = get_called_class();
            $item = new $className();
            $item->createFromDb($row);
            return $item;
        }
        
        /**
         * Get an item by the primarykey
         */
        static function getByPrimaryKey($value){
            $condition = array();
            $condition[static::$primaryKey] = $value;
            return self::getOne($condition);
        }
        
        /**
         * Get the number of items
         */
        static function getCount($condition=array()){
           $query = "SELECT COUNT(*) FROM " . static::$tableName;
            if(!empty($condition)){
                $query .= " WHERE ";
                foreach ($condition as $key => $value) {
                    $query .= $key . "=:".$key." AND ";
                }
            }
            $query = rtrim($query,' AND ');
            $db = Database::getInstance();
            $s = $db->getPreparedStatment($query);
            foreach ($condition as $key => $value) {
                $condition[':'.$key] = $value;
                unset($condition[$key]);
            }
            $s->execute($condition);
            $countArr = $s->fetch();
            return $countArr[0];
        }
        
    }

There are two static variables for storing the table name and the primary key. In the construct method, we define an array. This array contains all the column values for the Model.
Also Read:   Creating an html5 game like concentration

The save method runs the sql query ‘REPLACE INTO..’ which creates an entry if there is no entry for the current primary key and if the primary key is present, it updates the corresponding table.

The delete method deletes the current Model entry from the database.

The createFromdb() method is nothing but populates the columns array with its column values from the database row.

There are some static methods getAll(), getOne() etc. These are used to get a collection of Items or a single one according to the passed conditions. Note that we are using php late static binding. If we use the self keyword instead of static, we only get the empty strings we declared on the top of the Model class. So by using static keyword, we get the values which are declared in its extended classes.

Now we look into creating a User Model by extending the Model base class. Create a new folder called ‘model’ inside the ‘common’ folder. Inside the model folder, create a new file called User.class.php.

    <?php
    /**
     * User Model
     */
    class User extends Model {
     
        protected static $tableName = TABLE_USERS;
        protected static $primaryKey = 'id';
        
        const PRIV_ADMINISTRATOR = 1;
        const PRIV_MODERATOR= 2;
        const PRIV_EDITOR= 3;
        const PRIV_MEMBER= 8;
        const PRIV_GUEST= 99;
        
        
        function setId($value){
            $this->setColumnValue('id', $value);
        }
        function getId(){
            return $this->getColumnValue('id');
        }
        
        function setUsername($value){
            $this->setColumnValue('username', $value);
        }
        function getUsername(){
            return $this->getColumnValue('username');
        }
        
        function setPassword($value){
            $this->setColumnValue('password', $value);
        }
        function getPassword(){
            return $this->getColumnValue('password');
        }
        
        function setEmail($value){
            $this->setColumnValue('email', $value);
        }
        function getEmail(){
            return $this->getColumnValue('email');
        }
        
        function setFullname($value){
            $this->setColumnValue('fullname', $value);
        }
        function getFullname(){
            return $this->getColumnValue('fullname');
        }
        
        function setPrivilege($value){
            $this->setColumnValue('privilege', $value);
        }
        function getPrivilege(){
            return $this->getColumnValue('privilege');
        }
    }
