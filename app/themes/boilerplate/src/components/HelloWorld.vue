<template>
  <h1>Vue {{ msg }}</h1>

  <!-- IMPORTANT this image url works just fine -->
  <!-- BUT you need to create a symlink on dev server to map this folder during dev -->
  <!-- ln -s {path_to_project}/app/themes/boilerplate/src/assets {path_to_project}/html/assets -->
  <!-- on production everything will work just fine -->

  <img
    alt="Vue logo"
    src="../assets/logo.png"
  >
  <button @click="count++">
    count is: {{ count }}
  </button>
  <p>Edit <code>components/HelloWorld.vue</code> to test hot module replacement.</p>
</template>
<script>
export default {
  name: 'HelloWorld',
  props: {
    msg: String,
    default: ''
  },
  data() {
    return {
      count: 0
    }
  }
}
</script>
