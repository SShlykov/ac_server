<template>
        <div class="card w-100 p-3 data-block d-flex justify-content-between flex-row flex-wrap main-carphoto-block">
                <figure class="w30">
                    <img :src="this.carphotos.car_photo_front" alt="Фото машины передний план" class="w-100">
                    <figcaption>
                        Фото машины передний план
                    </figcaption>
                </figure>
                <figure class="w30">
                    <img :src="this.carphotos.car_photo_side" alt="Фото машины план с боку" class="w-100">
                    <figcaption>
                        Фото машины план с боку
                    </figcaption>
                </figure>
                <figure class="w30">
                    <img :src="this.carphotos.car_photo_back" alt="Фото машины задний план" class="w-100">
                    <figcaption>
                        Фото машины задний план
                    </figcaption>
                </figure>
            </div>
</template>

<script>
  import Spinner from "../common/spinner";
  export default {
    name: "CarPhotoBlock",
    components: {Spinner},
    props: ['car_id', 'changeLoadingStatus'],
    data() {
      return {
        carphotos: {
          car_id: "",
          car_photo_back: "",
          car_photo_front: "",
          car_photo_side: ""
        }
      }
    },
    async created() {
      await this.getCarPhoto();
      this.changeLoadingStatus();
    },
    methods: {
      async getCarPhoto() {
        await fetch(`/api/carphoto/${this.car_id}`)
          .then(res => res.json())
          .then(res => this.carphotos = res.data)
          .catch(err => console.log(err))
      }
    }
  }
</script>

<style scoped>

</style>
