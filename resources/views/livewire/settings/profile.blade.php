<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component {
    public string $name = '';
    public string $email = '';

    /**
     * Mount the component.
     */
    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    /**
     * Update the profile information for the currently authenticated user.
     */
    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],

            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($user->id)
            ],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    /**
     * Send an email verification notification to the current user.
     */
    public function resendVerificationNotification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $this->redirectIntended(default: route('dashboard', absolute: false));

            return;
        }

        $user->sendEmailVerificationNotification();

        Session::flash('status', 'verification-link-sent');
    }
}; ?>
<section class="w-full">
    @include('partials.settings-heading')
      <x-settings.layout :heading="__('Perfil')" :subheading="__('Actualiza tu nombre y correo electrónico')">  
        <form wire:submit="updateProfileInformation" class="my-6 w-full space-y-6">
            @if(auth()->user()->google())
            <flux:input wire:model="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name"/>
            @else
            <flux:input wire:model="name" :label="__('Nombre')" type="text" required autofocus autocomplete="name" disabled/>
            @endif
            <div>
            @if(auth()->user()->google())
            <flux:input wire:model="email" :label="__('Correo electrónico')" type="email" required autocomplete="email"/>

                @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail &&! auth()->user()->hasVerifiedEmail())
                    <div>
                        <flux:text class="mt-4">
                            {{ __('Tu correo electrónico no está verificado.') }}

                            <flux:link class="text-sm cursor-pointer" wire:click.prevent="resendVerificationNotification">
                                {{ __('Click aquí para reenviar verificacion de correo electrónico.') }}
                            </flux:link>
                        </flux:text>

                        @if (session('status') === 'verification-link-sent')
                            <flux:text class="mt-2 font-medium !dark:text-green-400 !text-green-600">
                                {{ __('Un nuevo enlace de verificación enviado a tu correo electronico.') }}
                            </flux:text>
                        @endif
                    </div>
                @endif

                @else
            <flux:input wire:model="email" :label="__('Correo electrónico')" type="email" required autocomplete="email" disabled/>
                <br><p>¡No puedes modificar tu perfil porque has iniciado con google!</p>
            @endif
            </div>

@if(auth()->user()->google())
            <div class="flex items-center gap-4">
                <div class="flex items-center justify-end">
                    <flux:button variant="primary" type="submit" class="w-full" data-test="update-profile-button">
                        {{ __('Guardar') }}
                    </flux:button>
                </div>

                <x-action-message class="me-3" on="profile-updated">
                    {{ __('¡Guardado!') }}
                </x-action-message>
            </div>
        @endif        
        </form>


        <livewire:settings.delete-user-form />
    </x-settings.layout>
</section>
