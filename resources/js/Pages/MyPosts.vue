<template>
  <Head title="My posts"/>

  <BreezeAuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        My posts
      </h2>
    </template>

    <div class="flex justify-end mb-4">
      <Link :href="route('post.create')"
            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
        Create a new post
      </Link>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
      <template v-for="(post, index) in posts.data" :key="index">
        <PostCard :post="post"/>
      </template>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script setup>
import {Head, Link,} from '@inertiajs/inertia-vue3';
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated';
import PostCard from '@/Components/PostCard'

const props = defineProps({
  posts: Object,
})
</script>
