<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        if(auth()->user()->google()){
           $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]); 
        }
        
        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Eliminar cuenta') }}</flux:heading>
        <flux:subheading>{{ __('Eliminar cuenta y todos sus datos') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" data-test="delete-user-button">
            {{ __('Eliminar cuenta') }}
        </flux:button>
    </flux:modal.trigger>

    @if(auth()->user()->google())
    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('¿Seguro que quieres eliminar tu cuenta?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Cuando se elimine la cuenta, todos tus datos serán eliminados permanentemente. Introduce tu contraseña para confirmar.') }}
                </flux:subheading>
            </div>

            <flux:input wire:model="password" :label="__('Contraseña')" type="password" />

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>

                <flux:button variant="danger" type="submit" data-test="confirm-delete-user-button">
                    {{ __('Eliminar cuenta') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
    @else
    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
    <form method="POST" wire:submit="deleteUser" class="space-y-6">
        <div>
            <flux:heading size="lg">{{ __('¿Seguro que quieres eliminar tu cuenta?') }}</flux:heading>

            <flux:subheading>
                {{ __('Cuando se elimine la cuenta, todos tus datos serán eliminados permanentemente. Esta acción no se puede deshacer.') }}
            </flux:subheading>
        </div>

        <div class="flex justify-end space-x-2 rtl:space-x-reverse">
            <flux:modal.close>
                <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
            </flux:modal.close>

            <flux:button
                variant="danger"
                type="submit"
                wire:confirm="{{ __('¿Seguro que deseas eliminar tu cuenta? Esta acción es permanente.') }}"
                data-test="confirm-delete-user-button"
            >
                {{ __('Eliminar cuenta') }}
            </flux:button>
        </div>
    </form>
</flux:modal>
    @endif
</section>
