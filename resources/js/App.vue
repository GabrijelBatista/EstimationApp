<template>
  <NavBar class="shadow-2xl mb-20 rounded-b-3xl sticky z-50 inset-x-0 shadow-xl min-w-full lg:mx-auto top-0 "/>
    <router-view v-slot="{ Component }" class="-mt-16  bg-hero-lg bg-fixed">
      <transition name="slide-fade" mode="out-in">
        <component :is="Component" />
      </transition>
    </router-view>
</template>

<script>
import NavBar from './components/navigation/NavBar.vue'
export default{
  components: {
    NavBar
  },
}
</script>

<style>
html{
    background-color: #e9f5db;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
    background-color: #e9f5db;
}
.slide-fade-enter-active {
    transition: all 0.5s ease-out;
}

.slide-fade-leave-active {
    transition: all 0.5s cubic-bezier(1, 0.5, 0.8, 1);
}

.slide-fade-enter-from,
.slide-fade-leave-to {
    transform: translateX(20px);
    opacity: 0;
}
</style>
