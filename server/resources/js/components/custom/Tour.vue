<template>
  <div class="tour_card">
    <div class="tour_card_info">
      <div class="tour_card_icon">
        <figure>
          <img src="../../../../public/storage/images/bus.svg" alt="bus" />
        </figure>
      </div>
      <a :href="'/home/category/' + id" class="tour_card_title" v-if="!edit">{{tourItem.name}}</a>
      <input type="text" class="main_input ml-4" v-if="edit" v-model="tourItem.name" />
    </div>
    <div class="tour_card_functions">
      <div class="tour_functions_delete d-flex">
        <figure class="mb-0" @click.prevent="toggleEdit">
          <img src="../../../../public/storage/images/pen.svg" alt="edit" v-if="!edit" />
          <img src="../../../../public/storage/images/close.svg" alt="close" v-if="edit" />
        </figure>
        <figure class="mb-0 ml-3">
          <img
            src="../../../../public/storage/images/save.svg"
            @click.prevent="updateName"
            alt="edit"
            v-if="edit"
          />
          <img
            @click.prevent="deleteItem"
            src="../../../../public/storage/images/trash.svg"
            alt="edit"
            v-if="!edit"
          />
        </figure>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Tour",
  props: {
    tour_disabled_up: {
      required: false
    },
    updateItem: {
      required: true
    },
    image: {
      required: false
    },
    time: {
      required: false
    },
    tour_disabled_down: {
      required: false
    },
    name: {
      required: true
    },
    id: {
      required: true
    }
  },
  data() {
    return {
      outputDiv: "Hellow my friend!",
      edit: false,
      tour_name: "",
      tourItem: {
        id: "",
        name: "",
        image: "",
        time: ""
      }
    };
  },
  async created() {
    await this.getTour();
  },
  methods: {
    async getTour() {
      this.tourItem.name = this.name;
      this.tourItem.id = this.id;
      this.tourItem.image = this.image;
      this.tourItem.time = this.time;
    },
    async updateName() {
      await fetch(`/api/tour/`, {
        method: "put",
        body: JSON.stringify(this.tourItem),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          alert(`Имя обновлено`);
          this.updateItem();
        })
        .catch(err => console.log(err));
    },
    changeText() {
      this.outputDiv = "my little code";
    },
    toggleEdit() {
      this.edit = !this.edit;
    },
    async deleteItem() {
      console.log("22");
      if (confirm("Вы точно хотите удалить тур?")) {
        await fetch(`/api/tour/` + this.id, {
          method: "delete"
        })
          .then(res => res.json())
          .then(data => {})
          .catch(err => console.log(err));
      }
      this.updateItem();
    }
  },
  components: {}
};

// <a :class="'tour_functions_down ' + tour_disabled_down" href="#">
//   <figure>
//     <img src="../../../../public/images/arrow_down.svg" alt="down" />
//   </figure>
// </a>
// <a :class="'tour_functions_up ' + tour_disabled_up" href="#">
//   <figure>
//     <img src="../../../../public/images/arrow_up.svg" alt="up" />
//   </figure>
// </a>
</script>