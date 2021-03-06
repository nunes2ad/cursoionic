<?php

namespace CodeDelivery\Services;


use CodeDelivery\Repositories\ClientRepository;
use CodeDelivery\Repositories\UserRepository;

class ClientService {

    public function __construct(ClientRepository $clientRepository, UserRepository $userRepository){

        $this->clientRepository = $clientRepository;
        $this->userRepository = $userRepository;
    }

    public function update(array $data, $id){

        $userId = $this->clientRepository->find($id)->user_id;

        $this->clientRepository->update($data, $id);
        $this->userRepository->update($data['user'],$userId);
    }

    public function create(array $data){

        $data['user']['password'] = bcrypt('123456');
        $user = $this->userRepository->create($data['user']);

        $data['user_id'] = $user->id;
        $this->clientRepository->create($data);
    }
}