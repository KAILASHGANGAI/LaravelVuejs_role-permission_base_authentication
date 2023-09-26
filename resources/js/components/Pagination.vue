<template>
    <div class="pagination">
      <ul>
        <li v-for="page in pages" :key="page" @click="paginate(page)">
          {{ page }}
        </li>
      </ul>
    </div>
  </template>
  
  <script>
  export default {
    props: {
      totalPages: Number,
    },
    data() {
      return {
        currentPage: 1,
      };
    },
    computed: {
      pages() {
        return Array.from({ length: this.totalPages }, (_, index) => index + 1);
      },
    },
    methods: {
      paginate(page) {
        this.currentPage = page;
        this.$emit('page-changed', page);
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your CSS styles for pagination here */
  </style>
  