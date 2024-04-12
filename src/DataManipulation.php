<?php		

require_once ("Repository.php");

class DataManipulation {
    protected $index; // номер записи
    protected $repository; 
    protected $record = [];
    
	public function __construct(RepositoryInterface $JSONrep)
    {
		
		$this->repository = $JSONrep;
    }

// получение значений для новой записи
     public function setRecord($name, $tel)
    {
        $this->record['name'] = $name;
        $this->record['tel'] = $tel;
        return $this->record;
    }

// получение номера записи	
     public function setIndex(int $index)
    {
        $this->index = $index;
        return $this->index;
    }
	
     public function write()
    {
        $this->repository->write($this->record);
    }
	
     public function read()
    {
        return $this->repository->read();
    }
	
     public function del()
    {
		$this->repository->del($this->index);
		return "ok";
    }
 }