<?php

namespace App\Http\Controllers;

use App\Services\SuccessfulEmailService;
use App\Http\Requests\StoreEmailRequest;
use App\Http\Requests\UpdateEmailRequest;

class EmailController extends Controller
{
    protected $emailService;

    public function __construct(SuccessfulEmailService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function index()
    {
        $emails = $this->emailService->getAllEmails();
        return response()->json($emails);
    }

    public function show($id)
    {
        $email = $this->emailService->getEmailById($id);
        return response()->json($email);
    }

    public function store(StoreEmailRequest $request)
    {
        $email = $this->emailService->createEmail($request->validated());
        return response()->json($email, 201);
    }

    public function update(UpdateEmailRequest $request, $id)
    {
        $email = $this->emailService->updateEmail($id, $request->except(['id', 'created_at', 'updated_at']));
        return response()->json($email);
    }

    public function destroy($id)
    {
        $this->emailService->deleteEmail($id);
        return response()->json(null, 204);
    }
}
