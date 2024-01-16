<template>
  <div class="container">
    <img src="@/assets/paws.png" class="paws" />
    <h1>Tell us about your pet</h1>
    <b-form>

      <b-form-group 
        id="input-group-1" 
        label="Choose your type of pet"
        label-for="petType"
        v-slot="{ ariaDescribedby }"
      >
        <b-form-radio-group
          v-model="form.petType"
          id="petType"
          :aria-describedby="ariaDescribedby"
          @change="checkPetType($event)"
          stacked
          class="custom-control custom-radio"
        >
          <b-form-radio value="Dog" size="lg"><p class="r-btn">Dog</p></b-form-radio>
          <b-form-radio value="Cat" size="lg"><p class="r-btn">Cat</p></b-form-radio>
        </b-form-radio-group>
      </b-form-group>

      <!--DOG-->
      <b-form-group 
        v-if="form.petType =='Dog'"
        id="input-group-2"
        label="What is your dog's name?"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="form.name"
          placeholder="Milly"
          required
        ></b-form-input>
      </b-form-group>
      <!--DOG End-->

      <!--CAT-->
      <b-form-group 
        v-if="form.petType =='Cat'"
        id="input-group-2"
        label="What is your cat's name?"
        label-for="input-2"
      >
        <b-form-input
          id="input-2"
          v-model="form.name"
          placeholder="Puddles"
          required
        ></b-form-input>
      </b-form-group>
      <!--CAT end-->


      <b-form-group id="input-group-3" label="What breed are they?" label-for="input-3">
        <b-form-select
          id="input-3"
          v-model="form.breed"
          :options="breedList"
          @change="updateBreedOption($event, 'breed')"
        ></b-form-select>
        <b-icon-search></b-icon-search>

        <b-form-group 
          v-if="breedOption != undefined"
          id="input-group-3b" 
          label="Choose One"
          label-for="petBreedOption"
          v-slot="{ ariaDescribedby }"
        >
          <b-form-radio-group
            id="petBreedOption"
            :aria-describedby="ariaDescribedby"
            @change="updateBreedOption($event, 'option')"
          >
            <b-form-radio value="Unknown"><p class="r-btn">I don't know</p></b-form-radio>
            <b-form-radio value="Mix"><p class="r-btn">It's a mix</p></b-form-radio>
          </b-form-radio-group>

          <b-form-group 
            v-if="breedOptions =='Mix'"
            id="input-group-3c"
            label-for="input-3c"
          >
            <b-form-input
              id="input-3d"
              v-model="form.breeds"
              placeholder="Collie, poodle, lab"
            ></b-form-input>
          </b-form-group>
        </b-form-group>
      </b-form-group>

      <b-form-group 
        id="input-group-4" 
        label="What gender are they?"
        label-for="gender"
        v-slot="{ ariaDescribedby }"
      >
        <b-form-radio-group
          v-model="form.gender"
          id="gender"
          :aria-describedby="ariaDescribedby"
        >
          <b-button 
            v-bind:class="(selectedGender=='Female')?'active-gender':null"  
            @click="updateGender($event)" class="gender-btn gender-btn-left" 
            variant="outline-primary" 
            value="Female"
          >
            Female
          </b-button>
          <b-button 
            v-bind:class="(selectedGender=='Male')?'active-gender':null" 
            @click="updateGender($event)" 
            class="gender-btn gender-btn-right" 
            variant="outline-primary" 
            value="Male"
          >
            Male
          </b-button>
        </b-form-radio-group>
      </b-form-group>

      <b-button id="continue" type="submit" class="activity-btn" @click="formRender($event)" disabled>Continue</b-button>
    </b-form>
    <p>{{formMsg}}</p>
    <!-- <b-card class="mt-3" header="Form Data Result">
      <pre class="m-0">{{ form }}</pre>
    </b-card> -->
  </div>
</template>

<script>
export default {
  name: 'RegisterForm',
  data() {
    return {
      form: {
        petType: 'Dog',
        name: '',
        breed: '',
        breeds: '',
        gender: null,
      },
      dogBreeds: [{ text: 'Select One', value: null }, 'Beagle', 'Whippet', 'Yorkie', 'German Shepherd', 'Bulldog', 'Poodle', 'Husky', "Can't find it?"],
      catBreeds: [{ text: 'Select One', value: null }, 'Siamese', 'Maine Coon', 'Persian', 'Sphynx', 'Burmese', 'Birman', 'American Shorthair', "Can't find it?"],
      breedList: [{ text: 'Select One', value: null }, 'Beagle', 'Whippet', 'Yorkie', 'German Shepherd', 'Bulldog', 'Poodle', 'Husky', "Can't find it?"],

      breedOption: undefined,
      breedOptions: undefined,

      selectedGender: false,

      formMsg: ''
    }
  },
  methods: {
    checkPetType(e) {
      if(e == 'Dog'){
        this.breedList = this.dogBreeds;
      }else{
        this.breedList = this.catBreeds;
      }
    },
    updateBreedOption(e, origin) {
      if(e == `Can't find it?`){
        this.breedOption = e;
      }else{
        if(origin == 'breed') {
          this.breedOption = undefined;
          this.breedOptions = undefined;
        }else{
          this.form.breed = '';
          this.breedOptions = e;
        }
      } 
      this.continueReady();    
    },
    updateGender(e) {
      this.form.gender = e.target.value;
      this.selectedGender = this.form.gender;
      this.continueReady();
    },
    clearError() {
      setTimeout(()=>{ this.formMsg = ''; }, 6000);   
    },
    continueReady() {
      let btn = document.getElementById('continue');
      if(this.form.petType != '' && this.form.name != '' && this.form.gender != ''){
        btn.classList.remove('disabled');
        btn.removeAttribute('disabled');
      }else{
        btn.classList.add('disabled');
        btn.setAttribute('disabled', true);
      }
    },
    formRender(e) {
      e.preventDefault();

      let obj = {
        name:'',
        type:'',
        breed:'',
        gender:''
      };
      let breed = '';

      if(this.form.petType == ''){
        this.formMsg = 'You need to select what type of pet you have.';
        this.clearError();
        return;
      }else if(this.form.name == ''){
        this.formMsg = 'You must enter in the pets name.';
        this.clearError();
        return;
      }else if(this.form.gender == ''){
        this.formMsg = 'You must select the pets gender.';
        this.clearError();
        return;
      }else if(this.form.breed == '' && this.breedOption == undefined){
        this.formMsg = 'You need to identify the pets breed.';
        this.clearError();
        return;
      }else if(this.breedOption != undefined){
        if(this.breedOptions == 'Unknown'){
          breed = "I don't know";
        }else if(this.breedOptions == 'Mix'){
          if(this.form.breeds == '') {
            this.formMsg = 'You need to best identify the pets breeds.';
            this.clearError();
            return;
          }else{
            breed = this.form.breeds;
          }
        }
      }else {
        breed = this.form.breed;
      }

      obj.name = this.form.name;
      obj.type = this.form.petType;
      obj.breed = breed;
      obj.gender = this.form.gender;

      this.onSubmit(e, obj);
    },
    onSubmit(event, obj) {
      event.preventDefault()

      let formData = new FormData();
      formData.append('name', obj.name);
      formData.append('type', obj.type);
      formData.append('breed', obj.breed);
      formData.append('gender', obj.gender);

      try {
        fetch("http://127.0.0.1:8000/api/pets",
        {
          mode:'no-cors',
          headers: {
            "Content-Type": "application/json"
          },
          body: formData,
          method: "post"
        }).then(() => {
          this.formMsg = obj.name + ', has been saved.'
          this.clearError();
        });
      } catch(err) {
        this.formMsg = err.message;
        this.clearError();
      }
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h1 {
  color:#072b71;
  font-weight:bold;
  font-size:1.5em;
  margin: 10px 0 20px 0;
}
select {
  appearance: none;
  background-color: var(--bs-body-bg);
  background-clip: padding-box;
  border: var(--bs-border-width) solid var(--bs-border-color);
  border-radius: var(--bs-border-radius);
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
  width: 100%;
  height: 38px;
  text-indent: 13px;
}

.custom-control-input {
  margin-right:15px!important;
}

.container {
  position:relative;
  border-radius: 6px;
  background-color:#fff;
  box-shadow: rgba(0,0,0,0.07) 0px 5px 5px;
  padding:10px 50px;
  height: auto;
  width:50vw;
  min-width:0px;
  max-width:600px;
  margin:0 auto;
  margin-top:50px;
  text-align: left;
}
.paws {
  width:100%;
}

.form-group {
  margin: 20px 0;
}

.r-btn {
  margin-left: 15px!important;
  margin-bottom:8px;
}

#petType {
  margin-left: 15px!important;
}

#input-group-3 {
  position:relative;
}

#input-group-3b {
  margin-left: 15px;
}

.bi-search {
  position: absolute;
  top: 35px;
  right: 10px;
}
.gender-btn {
  width:100px;
  margin:0!important;
  border-color:#55a1ee;
  color:#55a1ee;
}
.active-gender, .gender-btn:hover {
  color:#fff!important;
  background-color:#55a1ee!important;
}
.gender-btn-left {
  border-top-right-radius: 0px;
  border-bottom-right-radius: 0px;
}
.gender-btn-right {
  margin-left:-1px!important;
  border-top-left-radius: 0px;
  border-bottom-left-radius: 0px;
}


@media only screen and (max-width: 768px) {
  .container {
    width:100vw;
    max-width:calc(100% - 20px);
  }
}
</style>
