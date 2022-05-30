<template>
  <div @click="openPost"
       class="p-6 bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700 cursor-pointer">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ post.title }}</h5>
    <p class="mb-6 font-normal text-gray-700 dark:text-gray-400">{{ post.description }}</p>
    <p class="text-sm text-gray-500 dark:text-gray-400">
      {{ post.user.name }} - <i>{{ post.created_at }}</i>
      <span class="float-right">Comments: {{post.comment_count}}</span>
    </p>
  </div>
</template>

<script setup>
import {Inertia} from '@inertiajs/inertia'

const props =defineProps({
  post: Object,
});

const openPost = () => {
  Inertia.visit(route('post.show', props.post.id))
};
</script>