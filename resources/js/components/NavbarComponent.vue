<template>
  <div class="list-group list-group-transparent px-4 mb-3">
    <a :class="['list-group-item', 'list-group-item-action', 'd-flex', 'align-items-center', (index === 0 ? 'active' : '')]"
       v-for="(navData, index) in navigations" :href="navData.url">
      {{ navData.name || '---' }}
      <small class="text-secondary ms-auto" v-if="navData.count > 0">{{ navData.count }}</small>
    </a>
  </div>
</template>

<script>
export default {
  props: [],
  data() {
    return {
      navigations: {}
    }
  },
  mounted() {
    this.getNavigationMenu();
    console.log('Component navbar mounted.')
  },
  methods: {
    async getNavigationMenu() {
      try {
        const post = await this.$axios.post('/ajax/getNavigationMenu', {});
        console.log(post.data);
        this.navigations = post.data.response;
      } catch (error) {
        console.error('An error occurred while fetching online users:', error);
      }
    },
  }
}
</script>

<style scoped>
.icon-2x {
  font-size: 20px;
}
</style>
