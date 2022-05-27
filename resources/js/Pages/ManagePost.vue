<template>
  <Head title="Create a post"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create a post
      </h2>
    </template>

    <BreezeValidationErrors class="mb-4"/>

    <form @submit.prevent="submit">
      <div>
        <BreezeLabel for="title" value="Title"/>
        <BreezeInput id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus
                     autocomplete="title"/>
      </div>

      <div class="mt-2">
        <BreezeLabel for="description" value="Description"/>
        <textarea
            class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm w-full h-40"
            v-model="form.description" name="description" id="description" ref="input">

        </textarea>
      </div>

      <BreezeButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
        Submit
      </BreezeButton>
    </form>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';

const form = useForm({
  title: '',
  description: '',
});

const submit = () => {
  form.post(route('post.store'), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
};
</script>