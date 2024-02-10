<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Http\{
    Request,
    UploadedFile
};
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;

class UserService implements UserServiceInterface
{
    /**
     * The model instance.
     *
     * @var App\User
     */
    protected $model;

    /**
     * The request instance.
     *
     * @var \Illuminate\Http\Request
     */
    protected $request;

    /**
     * Constructor to bind model to a repository.
     *
     * @param \App\User                $model
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(User $model, Request $request)
    {
        $this->model = $model;
        $this->request = $request;
    }

    /**
     * Define the validation rules for the model.
     *
     * @param  int $id
     * @return array
     */
    public function rules($id = null)
    {
        return [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname'  => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'username'  => ['required', 'string', 'max:255',
                Rule::unique('users')->ignore($id),
            ],
            'password'  => ['nullable', 'string', 'min:8'],
            'photo'     => ['nullable', 'image'],
        ];
    }

    /**
     * Retrieve all resources and paginate.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function list()
    {
        return $this->model->paginate(40);
    }

    /**
     * Create model resource.
     *
     * @param  array $attributes
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(array $attributes)
    {
        if($this->request->hasfile('photo')){
            $attributes['photo'] = $this->upload($this->request->file('photo'));
        }
        $attributes['password'] = $this->hash($attributes['password']);
        $user = User::create($attributes);
        return $user;
    }

    /**
     * Retrieve model resource details.
     * Abort to 404 if not found.
     *
     * @param  integer $id
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function find(int $id):? Model
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Update model resource.
     *
     * @param  integer $id
     * @param  array   $attributes
     * @return boolean
     */
    public function update(int $id, array $attributes): bool
    {
        $user = $this->find($id);
        if($this->request->hasfile('photo')){
            $attributes['photo'] = $this->upload($this->request->file('photo'));
        }
        if(empty( $attributes['password']))
        {
            unset($attributes['password']);
            $user->update($attributes);
        }else{
            $attributes['password'] = $this->hash($attributes['password']);
            $user->update($attributes);
        }
        return true;
    }

    /**
     * Soft delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function destroy($id)
    {
        // Code goes brrrr.
    }

    /**
     * Include only soft deleted records in the results.
     *
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    public function listTrashed()
    {
        return $this->model->onlyTrashed()->paginate();
    }

    /**
     * Restore model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function restore($id)
    {
        $this->model->where('id', $id)->withTrashed()->restore();
    }

    /**
     * Permanently delete model resource.
     *
     * @param  integer|array $id
     * @return void
     */
    public function delete($id)
    {
        $user = $this->model->findorfail($id);
        $user->delete();
    }

    /**
     * Generate random hash key.
     *
     * @param  string $key
     * @return string
     */
    public function hash(string $key): string
    {
        return Hash::make($key);
    }

    /**
     * Upload the given file.
     *
     * @param  \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function upload(UploadedFile $file)
    {
        $avatarName = time().'.'.$file->getClientOriginalExtension();
        $file->move(storage_path('app/public/avatars'), $avatarName);
        return $avatarName;
    }
}
