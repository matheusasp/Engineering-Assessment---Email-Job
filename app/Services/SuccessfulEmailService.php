<?php

namespace App\Services;

use App\Repositories\SuccessfulEmailRepositoryInterface;

class SuccessfulEmailService
{
    protected $emailRepository;

    public function __construct(SuccessfulEmailRepositoryInterface $emailRepository)
    {
        $this->emailRepository = $emailRepository;
    }

    public function getAllEmails()
    {
        return $this->emailRepository->getAll();
    }

    public function getEmailById($id)
    {
        return $this->emailRepository->find($id);
    }

    public function createEmail(array $data)
    {
        $data['raw_text'] = $this->extractPlainText($data['email']);
    
        return $this->emailRepository->create($data);
    }

    public function updateEmail($id, array $data)
    {
        return $this->emailRepository->update($id, $data);
    }

    public function deleteEmail($id)
    {
        $this->emailRepository->delete($id);
    }

    private function extractPlainText($rawEmail)
    {
        return strip_tags($rawEmail);
    }
}
