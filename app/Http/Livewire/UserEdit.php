<?php

namespace App\Http\Livewire;

class UserEdit extends UserManage
{
    protected $view = 'livewire.user-edit';

    protected function title()
    {
        return $this->user->name . ' | Edit User';
    }

    public function mount()
    {
        $this->authorize('update', $this->user);

        parent::mount();
    }

    public function submit()
    {
        $passwordHash = $this->user->password;

        parent::submit();

        $message = 'User successfully updated.';
        if ($passwordHash != $this->user->password) {
            $message .= ' The password has been changed.';
        }
        session()->flash('message', $message);

        return redirect()->route('users.show', $this->user);
    }
}
