<script setup lang="ts">
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { watch } from 'vue';

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

var nameMinLength = 3;
var nameMaxLength = 50;
var passwordMinLength = 6;
var passwordMaxLength = 20;

const submit = () => {
    if (form.password !== form.password_confirmation) {
        form.errors.password_confirmation = 'A senha e a confirmação de senha não coincidem.';
        return;
    }
    form.post(route('register'), {
        onError: (errors) => {
            form.errors = errors;
        },
    });
};

watch(() => form.password_confirmation, (newPassword) => {
    console.log(form.password, form.password_confirmation);
    form.errors.password_confirmation = '';

    if (form.password_confirmation.length == 0 || form.password == form.password_confirmation) {
        return;
    }

    if (form.password_confirmation.length < passwordMinLength) {
        form.errors.password_confirmation = `O campo deve ter no mínimo ${passwordMinLength} caracteres.`;
        return;
    }

    if (form.password_confirmation.length > passwordMaxLength) {
        form.errors.password_confirmation = `O campo deve ter no máximo ${passwordMaxLength} caracteres.`;
        return;
    }

    form.errors.password_confirmation = 'A senha e a confirmação de senha não coincidem.';
});
</script>

<template>
    <GuestLayout>
        <Head title="Registro" />

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="name" value="Nome" />

                <TextInput
                    id="name"
                    type="text"
                    class="block w-full mt-1"
                    v-model="form.name"
                    required
                    autofocus
                    :minlength="nameMinLength"
                    :maxlength="nameMaxLength"
                    autocomplete="name"
                    @update:errors="form.errors.name = $event.name"
                />

                <InputError class="mt-2" :message="form.errors.name" />
            </div>

            <div class="mt-4">
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="block w-full mt-1"
                    v-model="form.email"
                    required
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Senha" />

                <TextInput
                    id="password"
                    type="password"
                    class="block w-full mt-1"
                    v-model="form.password"
                    required
                    :minlength="passwordMinLength"
                    :maxlength="passwordMaxLength"
                    autocomplete="new-password"
                    @update:errors="form.errors.password = $event.name"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="mt-4">
                <InputLabel
                    for="password_confirmation"
                    value="Confirmação de Senha"
                />

                <TextInput
                    id="password_confirmation"
                    type="password"
                    class="block w-full mt-1"
                    v-model="form.password_confirmation"
                    required
                    autocomplete="new-password"
                    @update:errors="form.errors.password_confirmation = $event.name"
                />

                <InputError
                    class="mt-2"
                    :message="form.errors.password_confirmation"
                />
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    :href="route('login')"
                    class="text-sm text-gray-600 underline rounded-md hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
                >
                    Já é registrado?
                </Link>

                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Registrar
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
