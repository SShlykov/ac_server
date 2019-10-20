<template>
  <div>
    <div
      v-if="!this.loading.data"
      class="card justify-content-center align-items-center p-3 d-flex w-100 h-100"
    >
      <Spinner />
    </div>
    <slot v-if="this.loading.data" :props="this.props" :changeLoadingStatus="changeLoadingStatus"></slot>
  </div>
</template>

<script>
import Spinner from "../spinner";
export default {
  name: "LoadingSpinner",
  components: { Spinner },
  props: ["props"],
  data() {
    return {
      loading: {
        data: false
      }
    };
  },
  methods: {
    changeLoadingStatus() {
      this.loading.data = true;
    }
  }
};
</script>

<style scoped>
</style>
