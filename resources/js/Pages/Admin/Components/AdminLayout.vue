<script setup>

    import { onMounted } from 'vue'
    import { initFlowbite } from 'flowbite'
    import Navbar from './Navbar.vue'
    import Sidebar from "./Sidebar.vue"

    onMounted(() => {
        initFlowbite();
    })

</script>

<template>
    <div class="antialiased bg-gray-50 dark:bg-gray-900">
        
        <!-- navbar start -->
        <Navbar />
        <!-- end -->

        <!-- Sidebar start -->
        <Sidebar />
        <!-- end -->

       <slot />

    </div>
</template>
