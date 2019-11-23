<template>
  <form @submit.prevent="addItem" class="card-body mb-3 item_form" accept="image/jpg, image/jpeg">
    <div v-for="item in this.data.fields" v-bind:key="item.name">
      <input
        class="form-control"
        v-bind:placeholder="item.name"
        v-bind:name="item.fieldName"
        v-bind:id="item.name"
        v-bind:type="item.type"
        v-model="data.item[item.name]"
      />
    </div>
    <button class="btn btn-primary" type="submit">+ Добавить</button>
  </form>
</template>

<script>
export default {
  props: {
    fields: {
      required: true
    },
    path: {
      required: true
    },
    fetchData: {
      required: true
    }
  },
  data() {
    return {
      data: {
        fields: [],
        item: {}
      }
    };
  },
  name: "FormAddItem",
  created() {
    this.parsePropsToState(this.fields);
  },
  methods: {
    parsePropsToState(arr) {
      let newArr = arr
        .map((el, idx) => {
          if (el === "id") {
            return;
          }
          this.data.item[el] = "";
          return {
            fieldName: el.split("_").join(" "),
            type: el === "photo" ? "file" : "string",
            name: el
          };
        })
        .filter(el => (el ? el : null));
      this.data.fields = newArr;
    },
    addItem(e) {
      let item = this.data.item;
      if (item["phone"]) {
        item.phone = item.phone.replace(/[^a-zA-Z0-9]/g, "");
      }
      fetch(`/api/${this.path.slice(0, -1)}`, {
        method: "post",
        body: JSON.stringify(this.data.item),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`Водитель: ${this.data.item.name} был успешно создан `);
          this.fetchData();
        })
        .catch(err => console.log(err));
    }
  }
};
</script>

<style scoped>
</style>
