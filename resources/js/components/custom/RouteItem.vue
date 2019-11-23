<template>
  <div class="routs_item_width">
    <div>{{name}}</div>
    <button class="btn btn-outline-danger ml-4">delete</button>
  </div>
</template>

<script>
export default {
  name: "RouteItem",
  props: {
    name: {
      required: true
    }
  }
};
</script>