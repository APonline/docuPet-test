<template>
  <div class="header">
    <div class="inner-container flex">
      <div class="v-align">
        <img src="@/assets/logo.png" width="200" />
      </div>
      <div class="flex v-align">
        <ul class="nav-items flex f-end">
          <li><a href="#">Help</a></li>
          <li><a class="activity" href="#">Save and Finish Later</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>
 
<script>
export default {
  name: 'HeaderNav',
  props: {}
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

.header {
  position: relative;
  background-color:#fff;
  padding: 10px 40px;
  box-shadow: rgba(0,0,0,0.1) 5px 5px 5px;
}
.inner-container {
  flex-direction: row;
  justify-content: center;
}
.nav-items {
  position: absolute;
  right:40px;
  margin:0px;
}

@media only screen and (max-width: 768px) {
  .inner-container {
    justify-content: flex-start;
  }
}
</style>
