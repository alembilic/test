<template>
  <Head title="View a post"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        View a post
      </h2>
    </template>

    <div class="flex justify-end mb-4">
      <Link v-if="can.edit" :href="route('post.edit', post.id)"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Edit
      </Link>

      <Link v-if="can.destroy" :href="route('post.destroy', post.id)" method="delete"
            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded ml-4">
        Delete
      </Link>
    </div>

    <div class="flex flex-wrap justify-between">
      <div class="w-full md:w-2/3">
        <span class="text-sm font-light text-gray-600 dark:text-gray-400">{{ post.created_at }}</span>
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-center">
          {{ post.title }}
        </h5>

        <p class="mb-6 font-normal text-gray-700 dark:text-gray-400">{{ post.description }}</p>

        <div class="flex items-center justify-between mt-4">
          <div class="flex items-center">
            <span class="text-gray-700 dark:text-gray-200 mr-2">Written by:</span>
            <span class="font-bold text-gray-700 dark:text-gray-200">{{ post.user.name }}</span>
          </div>
        </div>
      </div>
      <div class="w-full md:w-1/3 mt-8 md:mt-0">
        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
          Comments
        </h5>

        <form>
          <textarea
              v-model="form.comment"
              class="w-full h-20 p-2 border rounded focus:outline-none focus:ring-gray-300 focus:ring-1"
              name="comment"
              placeholder="Comment on this post...">
          </textarea>
          <BreezeButton class="mt-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
            Submit
          </BreezeButton>
        </form>

      </div>

    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head, Link, useForm} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import BreezeButton from '@/Components/Button.vue';

defineProps({
  post: Object,
  can: Object,
})

const form = useForm({
  comment: ''
});

const submit = () => {
  form.post(route('post.update', props.post.id), {
    preserveScroll: true,
    onSuccess: () => form.reset(),
  })
}
</script>
