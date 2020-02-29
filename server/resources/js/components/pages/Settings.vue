<template>
  <div class="w-100">
    <section class="d-flex justify-content-center">
      <button
        type="button"
        @click.prevent="changeViewContent('Planning')"
        class="btn btn-outline-dark"
      >Спланировать тур</button>
      <button
        @click.prevent="changeViewContent('About')"
        type="button"
        class="btn btn-outline-dark ml-2"
      >О нас</button>
      <button
        @click.prevent="changeViewContent('Contacts')"
        type="button"
        class="btn btn-outline-dark ml-2"
      >Контакты</button>
    </section>

    <section v-if="contentFlag=='Planning'">
      <h4 class="mb-3">Текст у иконок</h4>
      <div class="settings_planning d-flex">
        <div class="settings_planning-icons mb-5">
          <figure>
            <img src="../../../../public/images/car.svg" alt />
          </figure>
          <div v-if="!iconsEdit.CarEdit" class="mr-2">{{pageContent.planning_car.text}}</div>
          <input
            v-if="iconsEdit.CarEdit"
            type="text"
            class="main_input"
            v-model="pageContent.planning_car.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditCar()"
              v-if="!iconsEdit.CarEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.planning_car)"
              v-if="iconsEdit.CarEdit"
              class="mb-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditCar()"
              v-if="iconsEdit.CarEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
        <div class="settings_planning-icons mb-5">
          <figure>
            <img src="../../../../public/images/photo.svg" alt />
          </figure>
          <div v-if="!iconsEdit.PhotoEdit" class="mr-2">{{pageContent.planning_photo.text}}</div>
          <input
            v-if="iconsEdit.PhotoEdit"
            type="text"
            class="main_input"
            v-model="pageContent.planning_photo.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditPhoto()"
              v-if="!iconsEdit.PhotoEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.planning_photo)"
              v-if="iconsEdit.PhotoEdit"
              class="mb-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditPhoto()"
              v-if="iconsEdit.PhotoEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
        <div class="settings_planning-icons mb-5">
          <figure>
            <img src="../../../../public/images/coins.svg" alt />
          </figure>
          <div v-if="!iconsEdit.CoinsEdit" class="mr-2">{{pageContent.planning_coins.text}}</div>
          <input
            v-if="iconsEdit.CoinsEdit"
            type="text"
            class="main_input"
            v-model="pageContent.planning_coins.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditCoins()"
              v-if="!iconsEdit.CoinsEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.planning_coins)"
              v-if="iconsEdit.CoinsEdit"
              class="mb-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditCoins()"
              v-if="iconsEdit.CoinsEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
        <div class="settings_planning-icons mb-5">
          <figure>
            <img src="../../../../public/images/timer.svg" alt />
          </figure>
          <div v-if="!iconsEdit.TimeEdit" class="mr-2">{{pageContent.planning_time.text}}</div>
          <input
            v-if="iconsEdit.TimeEdit"
            type="text"
            class="main_input"
            v-model="pageContent.planning_time.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditTime()"
              v-if="!iconsEdit.TimeEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.planning_time)"
              v-if="iconsEdit.TimeEdit"
              class="mb-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditTime()"
              v-if="iconsEdit.TimeEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>
      <h4 v-if="!iconsEdit.TransferEdit" class="mb-3">{{pageContent.planning_transfer.heading}}</h4>
      <input
        v-if="iconsEdit.TransferEdit"
        type="text"
        class="main_input mb-2"
        v-model="pageContent.planning_transfer.heading"
      />
      <div class="settings_planning d-flex">
        <div class="settings_planning-textarea d-flex flex-column">
          <textarea-autosize
            readonly
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.planning_transfer.text"
            :min-height="30"
            :max-height="350"
            v-if="!iconsEdit.TransferEdit"
          />
          <textarea-autosize
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.planning_transfer.text"
            :min-height="30"
            :max-height="350"
            v-if="iconsEdit.TransferEdit"
          />
          <div class="mt-3">
            <button
              @click.prevent="toggleItemEditTransfer()"
              v-if="!iconsEdit.TransferEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.planning_transfer)"
              v-if="iconsEdit.TransferEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditTransfer()"
              v-if="iconsEdit.TransferEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>
    </section>

    <section v-if="contentFlag=='About'">
      <h4 v-if="!iconsEdit.RestEdit" class="mb-3">{{pageContent.about_rest.heading}}</h4>
      <input
        v-if="iconsEdit.RestEdit"
        type="text"
        class="main_input mb-2"
        v-model="pageContent.about_rest.heading"
      />
      <div class="settings_planning d-flex mb-5">
        <div class="settings_planning-textarea d-flex flex-column">
          <textarea-autosize
            readonly
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_rest.text"
            :min-height="30"
            :max-height="350"
            v-if="!iconsEdit.RestEdit"
          />
          <textarea-autosize
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_rest.text"
            :min-height="30"
            :max-height="350"
            v-if="iconsEdit.RestEdit"
          />
          <div class="mt-3">
            <button
              @click.prevent="toggleItemEditRest()"
              v-if="!iconsEdit.RestEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.about_rest)"
              v-if="iconsEdit.RestEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditRest()"
              v-if="iconsEdit.RestEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>

      <h4 v-if="!iconsEdit.AltayEdit" class="mb-3">{{pageContent.about_onaltai.heading}}</h4>
      <input
        v-if="iconsEdit.AltayEdit"
        type="text"
        class="main_input mb-2"
        v-model="pageContent.about_onaltai.heading"
      />
      <div class="settings_planning d-flex mb-5">
        <div class="settings_planning-textarea d-flex flex-column">
          <textarea-autosize
            readonly
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_onaltai.text"
            :min-height="30"
            :max-height="350"
            v-if="!iconsEdit.AltayEdit"
          />
          <textarea-autosize
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_onaltai.text"
            :min-height="30"
            :max-height="350"
            v-if="iconsEdit.AltayEdit"
          />
          <div class="mt-3">
            <button
              @click.prevent="toggleItemEditAltay()"
              v-if="!iconsEdit.AltayEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.about_onaltai)"
              v-if="iconsEdit.AltayEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditAltay()"
              v-if="iconsEdit.AltayEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>

      <h4 v-if="!iconsEdit.FamilyEdit" class="mb-3">{{pageContent.about_family.heading}}</h4>
      <input
        v-if="iconsEdit.FamilyEdit"
        type="text"
        class="main_input mb-2"
        v-model="pageContent.about_family.heading"
      />
      <div class="settings_planning d-flex mb-5">
        <div class="settings_planning-textarea d-flex flex-column">
          <textarea-autosize
            readonly
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_family.text"
            :min-height="30"
            :max-height="350"
            v-if="!iconsEdit.FamilyEdit"
          />
          <textarea-autosize
            placeholder="Текст отзыва"
            ref="myTextarea"
            v-model="pageContent.about_family.text"
            :min-height="30"
            :max-height="350"
            v-if="iconsEdit.FamilyEdit"
          />
          <div class="mt-3">
            <button
              @click.prevent="toggleItemEditFamily()"
              v-if="!iconsEdit.FamilyEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.about_family)"
              v-if="iconsEdit.FamilyEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditFamily()"
              v-if="iconsEdit.FamilyEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>
    </section>

    <section v-if="contentFlag=='Contacts'">
      <h4 class="mb-3">Контакты</h4>
      <div class="settings_planning d-flex">
        <div class="settings_planning-icons mb-5">
          <span v-if="!iconsEdit.PhoneEdit">{{pageContent.contacts_phone.heading}}</span>
          <input
            v-if="iconsEdit.PhoneEdit"
            type="text"
            class="w-20 main_input"
            v-model="pageContent.contacts_phone.heading"
          />
          <div v-if="!iconsEdit.PhoneEdit" class="mr-2">{{pageContent.contacts_phone.text}}</div>
          <input
            v-if="iconsEdit.PhoneEdit"
            type="text"
            class="w-35 main_input"
            v-model="pageContent.contacts_phone.text"
          />
          <div class="ml-3">
            <button
              @click.prevent="toggleItemEditPhone()"
              v-if="!iconsEdit.PhoneEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.contacts_phone)"
              v-if="iconsEdit.PhoneEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditPhone()"
              v-if="iconsEdit.PhoneEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>

        <div class="settings_planning-icons mb-5">
          <span v-if="!iconsEdit.MailEdit">{{pageContent.contacts_mail.heading}}</span>
          <input
            v-if="iconsEdit.MailEdit"
            type="text"
            class="w-20 main_input"
            v-model="pageContent.contacts_mail.heading"
          />
          <div v-if="!iconsEdit.MailEdit" class="mr-2">{{pageContent.contacts_mail.text}}</div>
          <input
            v-if="iconsEdit.MailEdit"
            type="text"
            class="w-35 main_input"
            v-model="pageContent.contacts_mail.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditMail()"
              v-if="!iconsEdit.MailEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.contacts_mail)"
              v-if="iconsEdit.MailEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditMail()"
              v-if="iconsEdit.MailEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>

        <div class="settings_planning-icons mb-5">
          <span v-if="!iconsEdit.VkEdit">{{pageContent.contacts_vk.heading}}</span>
          <input
            v-if="iconsEdit.VkEdit"
            type="text"
            class="w-20 main_input"
            v-model="pageContent.contacts_vk.heading"
          />
          <div v-if="!iconsEdit.VkEdit" class="mr-2">{{pageContent.contacts_vk.text}}</div>
          <input
            v-if="iconsEdit.VkEdit"
            type="text"
            class="w-35 main_input"
            v-model="pageContent.contacts_vk.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditVk()"
              v-if="!iconsEdit.VkEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.contacts_vk)"
              v-if="iconsEdit.VkEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditVk()"
              v-if="iconsEdit.VkEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>

        <div class="settings_planning-icons mb-5">
          <span v-if="!iconsEdit.FacebookEdit">{{pageContent.contacts_facebook.heading}}</span>
          <input
            v-if="iconsEdit.FacebookEdit"
            type="text"
            class="w-20 main_input"
            v-model="pageContent.contacts_facebook.heading"
          />
          <div v-if="!iconsEdit.FacebookEdit" class="mr-2">{{pageContent.contacts_facebook.text}}</div>
          <input
            v-if="iconsEdit.FacebookEdit"
            type="text"
            class="w-35 main_input"
            v-model="pageContent.contacts_facebook.text"
          />
          <div>
            <button
              @click.prevent="toggleItemEditFacebook()"
              v-if="!iconsEdit.FacebookEdit"
              class="btn btn-outline-primary"
            >Редактировать</button>
            <button
              @click.prevent="updateSetting(pageContent.contacts_facebook)"
              v-if="iconsEdit.FacebookEdit"
              class="mr-2 btn btn-outline-primary"
            >Сохранить</button>
            <button
              @click.prevent="toggleItemEditFacebook()"
              v-if="iconsEdit.FacebookEdit"
              class="btn btn-outline-dark"
            >Отмена</button>
          </div>
        </div>
      </div>
    </section>
  </div>
</template>

<script>
import Vue from "vue";
import TextareaAutosize from "vue-textarea-autosize";
Vue.use(TextareaAutosize);

export default {
  name: "ContentValue",
  components: {},
  data() {
    return {
      data: {
        item: {},
        fields: {},
        list: {}
      },
      contentFlag: "Planning",
      newGroup: false,
      iconsEdit: {
        CarEdit: false,
        PhotoEdit: false,
        CoinsEdit: false,
        TimeEdit: false,
        TransferEdit: false,
        RestEdit: false,
        AltayEdit: false,
        FamilyEdit: false,
        PhoneEdit: false,
        MailEdit: false,
        VkEdit: false,
        FacebookEdit: false
      },
      DBPageContent: [],
      pageContent: {
        about_family: { id: "", name: "", text: "", heading: "" },
        about_rest: { id: "", name: "", text: "", heading: "" },
        about_onaltai: { id: "", name: "", text: "", heading: "" },
        contacts_phone: { id: "", name: "", text: "", heading: "" },
        contacts_mail: { id: "", name: "", text: "", heading: "" },
        contacts_vk: { id: "", name: "", text: "", heading: "" },
        contacts_facebook: { id: "", name: "", text: "", heading: "" },
        planning_car: {
          id: "",
          name: "",
          text: "",
          heading: ""
        },
        planning_photo: { id: "", name: "", text: "", heading: "" },
        planning_transfer: { id: "", name: "", text: "", heading: "" },
        planning_coins: { id: "", name: "", text: "", heading: "" },
        planning_time: { id: "", name: "", text: "", heading: "" }
      }
    };
  },
  props: {},
  async created() {
    await this.fetchData();
    await this.getContent();
  },
  methods: {
    async clearPhotos() {
      console.log("i work");
    },
    async fetchData() {
      await fetch("/api/route_group/groups")
        .then(res => res.json())
        .then(res => {
          this.data.list = res.data;
        })
        .catch(err => console.warn(err));
    },
    async getContent() {
      await fetch("/api/settings/all")
        .then(res => res.json())
        .then(res => {
          this.DBPageContent = res.data;
        })
        .catch(err => console.warn(err));
      this.getContentObject();
    },
    async getContentObject() {
      for (let key in this.pageContent) {
        this.DBPageContent.map(x => {
          if (x.name == key) {
            this.pageContent[key].id = x.id;
            this.pageContent[key].name = x.name;
            this.pageContent[key].text = x.text;
            this.pageContent[key].heading = x.heading;
          }
        });
      }
    },
    async updateSetting(item) {
      await fetch(`/api/settings/update`, {
        method: "put",
        body: JSON.stringify(item),
        headers: {
          "Content-Type": "application/json"
        }
      })
        .then(res => res.json())
        .then(data => {
          console.log(item);
        })
        .catch(err => console.log(err));

      for (let key in this.iconsEdit) {
        this.iconsEdit[key] = false;
      }
      this.getContent();
    },
    toggleGroup() {
      this.newGroup = !this.newGroup;
    },
    key_random(item) {
      return Math.random() * Math.random();
    },
    route_group_post() {
      console.log(this.data.item.name);
      fetch(`/api/route_group/`, {
        method: "POST",
        body: JSON.stringify({
          name: this.data.item.name
        }),
        headers: {
          "Content-type": "application/json; charset=UTF-8"
        }
      })
        .then(res => res.json())
        .then(data => {
          console.log(`Группа создана`);
          this.fetchData();
        })
        .catch(err => console.log(err));
    },
    changeViewContent(item) {
      this.contentFlag = item;
    },
    toggleItemEditCar() {
      this.iconsEdit.CarEdit = !this.iconsEdit.CarEdit;
    },
    toggleItemEditPhoto() {
      this.iconsEdit.PhotoEdit = !this.iconsEdit.PhotoEdit;
    },
    toggleItemEditCoins() {
      this.iconsEdit.CoinsEdit = !this.iconsEdit.CoinsEdit;
    },
    toggleItemEditTime() {
      this.iconsEdit.TimeEdit = !this.iconsEdit.TimeEdit;
    },
    toggleItemEditTransfer() {
      this.iconsEdit.TransferEdit = !this.iconsEdit.TransferEdit;
    },
    toggleItemEditRest() {
      this.iconsEdit.RestEdit = !this.iconsEdit.RestEdit;
    },
    toggleItemEditAltay() {
      this.iconsEdit.AltayEdit = !this.iconsEdit.AltayEdit;
    },
    toggleItemEditFamily() {
      this.iconsEdit.FamilyEdit = !this.iconsEdit.FamilyEdit;
    },
    toggleItemEditPhone() {
      this.iconsEdit.PhoneEdit = !this.iconsEdit.PhoneEdit;
    },
    toggleItemEditMail() {
      this.iconsEdit.MailEdit = !this.iconsEdit.MailEdit;
    },
    toggleItemEditVk() {
      this.iconsEdit.VkEdit = !this.iconsEdit.VkEdit;
    },
    toggleItemEditFacebook() {
      this.iconsEdit.FacebookEdit = !this.iconsEdit.FacebookEdit;
    }
  }
};
</script>
