<template>
  <div class="d-flex flex-wrap">
    <div class="w-100">
      <h4>Категории</h4>
    </div>
    <EditItem
      :urlupdate="'/api/category/update'"
      v-for="item in categories"
      v-bind:key="random(item)"
      :name="item.name"
      :id="item.id"
      :update_i="getCeterories"
    ></EditItem>
  </div>
</template>



<script>
import EditItem from "./../custom/EditItem";

export default {
  name: "EditCategoris",
  components: { EditItem },
  data() {
    return {
      categories: []
    };
  },
  async created() {
    await this.getCeterories();
    console.log(this.categories);
  },
  methods: {
    async getCeterories() {
      await fetch("/api/category/all")
        .then(res => res.json())
        .then(res => {
          this.categories = res.data;
        })
        .catch(err => console.warn(err));
    },
    random(item) {
      return Math.random().toString(36);
    },
    getItem() {}
  }
};

//<tour :tour_disabled_up="'tour_disabled'"></tour>
//<tour :tour_disabled_down="'tour_disabled'"></tour>
</script>
