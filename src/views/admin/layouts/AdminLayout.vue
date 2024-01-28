<template>
  <div class="surface-300 flex min-w-full min-h-screen">
    <AdminSidebar />
    <div class="bg-orange-300 relative h-screen w-full">
        <AdminAppbar  />
      <main class="bg-green-300 mt-8">
        <router-view></router-view>
      </main>
    </div>
  </div>
</template>
<script>
import { RouterView } from "vue-router";
import AdminAppbar from "@/components/admin/AdminAppbar.vue";
import AdminSidebar from "@/components/admin/AdminSidebar.vue";

export default {
  components: {
    RouterView,
    AdminAppbar,
    AdminSidebar,
  },
};
</script>
<style></style>
