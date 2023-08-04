<template>
    <div style="padding-top: 0">
    <li class="list-group-item" id="list-item-1" :class="className" style="padding-top: 0px !important;"><slot></slot></li>
    <small class="badge float-end bg-danger" :class="badgeClass">You</small>
    </div>
    
</template>
<script>
export default {

props: ["color"],
 computed: {
   className() {
     return "list-group-item-" + this.color;
   },
   badgeClass(){
       return 'badge-'+this.color;
   }
 },
}
</script>
<style>

</style>