<?php		
interface RepositoryInterface {
    public function write(array $record);
    public function read();
    public function del(int $index);
}


 class JSONRepository implements RepositoryInterface {
    protected $jsonArray = [];
	protected $fileName = 'phonebook.json';
    
	public function __construct()
    {
        
		//Если файл существует - получаем его содержимое
		if (file_exists($this->fileName)){
			$file = file_get_contents($this->fileName);
			$this->jsonArray = json_decode($file, true);
			// Если такого файла нет…
		} else {
		// …то создаём его сами
			$this->file = fopen($this->fileName, "a+");
		}
    }

// запись в файл
    public function write(array $record)
    {
		array_push($this->jsonArray, $record);
		file_put_contents($this->fileName, json_encode($this->jsonArray, JSON_FORCE_OBJECT));
    }

// чтение из файла	
    public function read()
    {
        return $this->jsonArray;
    }

// удаление записи	
    public function del(int $index)
    {
        unset($this->jsonArray[$index]);
		file_put_contents($this->fileName, json_encode($this->jsonArray, JSON_FORCE_OBJECT));
    }
 }