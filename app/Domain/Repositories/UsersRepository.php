<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Users;
use App\Domain\Contracts\UsersInterface;
use App\Domain\Contracts\Crudable;


/**
 * Class UsersRepository
 * @package App\Domain\Repositories
 */
class UsersRepository extends AbstractRepository implements UsersInterface, Crudable
{

    /**
     * @var Users
     */
    protected $model;

    /**
     * UsersRepository constructor.
     * @param Users $users
     */
    public function __construct(Users $users)
    {
        $this->model = $users;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getAll()
    {
        return $this->model->all();
    }

    /**
     * @param int $limit
     * @param int $page
     * @param array $column
     * @param string $field
     * @param string $search
     * @return \Illuminate\Pagination\Paginator
     */
    public function paginate($limit = 10, $page = 1, array $column = ['*'], $field, $search = '')
    {
        // query to aql
   $indikatorbelanja = $this->model
->where('name', 'like', '%' . $search . '%')
->paginate($limit)
->toArray();
return $indikatorbelanja;
    }

    /**
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function create(array $data)
    {
        // execute sql insert
        return parent::create([
            'name'    => e($data['name']),
            'email'   => e($data['email']),
            'address' => e($data['address']),
            'ktp'   => e($data['ktp']),
            'phone'   => e($data['phone']),
            'level' => e($data['level']),
            'password' => e($data['password'])
            

        ]);

    }

    /**
     * @param $id
     * @param array $data
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function update($id, array $data)
    {
        return parent::update($id, [
            'name'    => e($data['name']),
            'email'   => e($data['email']),
            'address' => e($data['address']),
            'ktp'   => e($data['ktp']),
            'phone'   => e($data['phone']),
            'level' => e($data['level']),
            'password' => e($data['password'])
            
        ]);
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function delete($id)
    {
        return parent::delete($id);
    }


    /**
     * @param $id
     * @param array $columns
     * @return mixed
     */
    public function findById($id, array $columns = ['*'])
    {
        return parent::find($id, $columns);
    }

}