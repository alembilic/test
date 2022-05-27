<template>
  <Head title="Create a post"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create a post
      </h2>
    </template>

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
      </div>

    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';

defineProps({
  post: Object,
})
</script>
