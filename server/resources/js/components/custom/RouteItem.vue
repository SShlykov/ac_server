<template>
  <div class="routs_item_width">
    <div>{{ name }}</div>
    <button class="btn btn-outline-danger ml-4" @click.prevent="disconnect">delete</button>
  </div>
</template>

<script>
export default {
  name: "RouteItem",
  props: {
    name: {
      required: true
    },
    id: {
      required: true
    },
    route_id: {
      required: true
    },
    getRouts: {
      required: true
    },
    purpose: {
      required: true
    }
  },
  data() {
    return {
      item: {
        route_group_id: "",
        route_id: ""
      }
    };
  },
  async created() {
    this.item.route_group_id = this.route_id;
    this.item.route_id = this.id;
  },
  methods: {
    async disconnect() {
      if (this.purpose == "routegroups") {
        if (confirm("Вы точно хотите удалить?")) {
          await fetch(`/api/disconnect`, {
            method: "delete",
            body: JSON.stringify(this.item),
            headers: {
              "Content-Type": "application/json"
            }
          })
            .then(res => res.json())
            .then(data => {
              alert(`удален`);
              this.getRouts();
            })
            .catch(err => console.log(err));
        }
      }
      console.log(this.item);
      if (this.purpose == "driverrouts") {
        if (confirm("Вы точно хотите удалить?")) {
          await fetch(`/api/driver/rg/disconnect`, {
            method: "delete",
            body: JSON.stringify(this.item),
            headers: {
              "Content-Type": "application/json"
            }
          })
            .then(res => res.json())
            .then(data => {
              alert(`удален`);
              this.getRouts();
            })
            .catch(err => console.log(err));
        }
      }
      if (this.purpose == "tourcategory") {
        console.log("diconnet category");
        if (confirm("Вы точно хотите удалить?")) {
          await fetch(`/api/tour/disconnect/category`, {
            method: "delete",
            body: JSON.stringify(this.item),
            headers: {
              "Content-Type": "application/json"
            }
          })
            .then(res => res.json())
            .then(data => {
              alert(`удален`);
              this.getRouts();
            })
            .catch(err => console.log(err));
        }
      }
    }
  }
};
</script>


