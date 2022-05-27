<template>
  <Head title="Welcome"/>

  <div class="min-h-screen bg-gray-100">
    <div v-if="canLogin" class="px-6 py-4 sm:block sm:text-right">
      <Link v-if="$page.props.auth.user" :href="route('dashboard')" class="text-sm text-gray-700 underline">
        Dashboard
      </Link>

      <template v-else>
        <Link :href="route('login')" class="text-sm text-gray-700 underline">
          Log in
        </Link>

        <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm text-gray-700 underline">
          Register
        </Link>
      </template>
    </div>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg p-8">

        <p class="text-2xl font-bold pb-6">Posts from our users</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <template v-for="(post, index) in posts.data" :key="index">
            <PostCard :post="post"/>
          </template>
        </div>

        <Pagination :links="posts.links" class="mt-6 flex flex-row-reverse"/>
      </div>
    </div>
  </div>
</template>

<script setup>
import {Head, Link} from '@inertiajs/inertia-vue3';
import PostCard from '@/Components/PostCard'
import Pagination from '@/Components/Pagination'

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
  posts: Object,
})
</script>

<style scoped>
.bg-gray-100 {
  background-color: #f7fafc;
  background-color: rgba(247, 250, 252, var(--tw-bg-opacity));
}

.text-gray-700 {
  color: #4a5568;
  color: rgba(74, 85, 104, var(--tw-text-opacity));
}

@media (prefers-color-scheme: dark) {
  .dark\:bg-gray-800 {
    background-color: #2d3748;
    background-color: rgba(45, 55, 72, var(--tw-bg-opacity));
  }
}
</style>
