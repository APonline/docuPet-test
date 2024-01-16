<template>
  <div id="app">
    <HeaderNav />
    <RegisterForm />
  </div>
</template>

<script>
import HeaderNav from './components/HeaderNav.vue'
import RegisterForm from './components/RegisterForm.vue'

export default {
  name: 'App',
  components: {
    HeaderNav,
    RegisterForm
  }
}
</script>

<style>

/* RESET */
a,abbr,acronym,address,applet,article,aside,audio,b,big,blockquote,body,canvas,caption,center,cite,code,dd,del,details,dfn,div,dl,dt,em,embed,fieldset,figcaption,figure,footer,form,h1,h2,h3,h4,h5,h6,header,hgroup,html,i,iframe,img,ins,kbd,label,legend,li,mark,menu,nav,object,ol,output,p,pre,q,ruby,s,samp,section,small,span,strike,strong,sub,summary,sup,table,tbody,td,tfoot,th,thead,time,tr,tt,u,ul,var,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline}article,aside,details,figcaption,figure,footer,header,hgroup,menu,nav,section{display:block}body{line-height:1}ol,ul{list-style:none}blockquote,q{quotes:none}blockquote:after,blockquote:before,q:after,q:before{content:'';content:none}table{border-collapse:collapse;border-spacing:0}
/* RESET */

/* DEFAULTS */
* {
  box-sizing: border-box;
}
h3 {
  margin: 40px 0 0;
}
ul {
  list-style-type: none;
  padding: 0;
}
li {
  display: inline-block;
  margin: 0 10px;
}
a {
  color: #777777!important;
  text-decoration: none!important;
  font-weight: bold;
}
.activity, a:hover {
  color:#55a1ee!important;
}
.activity-btn {
  color:#fff!important;
  background-color:#55a1ee!important;
  border: none!important;
  padding: 8px 50px!important;
  position: relative;
  width: 165px;
  display: block!important;
  margin:40px auto;
}

label {
  font-weight: bold;
  color: gray;
}
/* DEFAULTS */

/* GLOBAL CUSTOM FLEX */
.flex {
  display:flex;
}
.f-end {
  justify-content: flex-end;
}

.v-align {
  justify-content: center;
  flex-direction: column;
}
/* GLOBAL CUSTOM FLEX */


#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale; 
  text-align: center;
  color: #2c3e50;
  background-color: #dbdbdb;
  height:100vh;
}

</style>
