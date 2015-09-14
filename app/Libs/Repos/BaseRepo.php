<?php namespace App\Libs\Repos;

class BaseRepo
{
	public $model;

	public function __construct()
	{
		$this->model = $this->boot();
	}

	public function makeModel( $data = '' )
	{
		return ( $data =='' )
				? new $this->model()
				: new $this->model($data);
	}

	public function all(Array $columns = ['*'])
	{
		/*return ($columns != null && !empty($columns)) 
				? $this->model->all()
				: $this->model->select($columns)->get();*/

		return $this->model->get($columns);
	}

	public function find($id, Array $columns = ['*'])
	{
		/*return ($columns != null && !empty($columns)) 
				? $this->model->find($id)
				: $this->model->where('id', $id)->select($columns)->get();*/
				
		return $this->model->find($id, $columns);
		
	}

    /**
     * @param $attribute
     * @param $value
     * @param array $columns
     * @return mixed
     */
    public function findBy($attribute, $value, $columns = ['*'])
    {
        return $this->model
        		->where($attribute, '=', $value)
        		->first($columns);
    }

    public function lists($columns)
    {
    	return $this->model->lists($columns);
    }

	public function update( $id, Array $data, $attribute = 'id' )
	{
		return $this->model->where($attribute, '=', $id)->update($data);
	}

	public function insert( Array $columns )
	{
		return $this->FieldsIterator($this->makeModel(), $columns)->save();
	}

	public function multiInsert( Array $data )
	{
		foreach ($data as $value) {
			$this->insert($value);
		}

		return true;
	}

	public function create( Array $columns )
	{
		return $this->model->create($columns);
	}

    /**
     * @param $id
     * @return mixed
     */
    public function delete($id) {
        return $this->model->destroy($id);
    }

	protected function FieldsIterator($model, Array $columns)
	{
		foreach ($columns as $column => $value) {
			$model->$column = $value;
		}

		return $model;
	}
}