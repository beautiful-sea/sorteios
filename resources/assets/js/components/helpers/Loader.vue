<template>
    <div   class=" loader-helper">
        <div v-if="spinner" class="spinner-border text-primary spinner"></div>
        <div class="slot">
            <slot></slot>
        </div>
    </div>
</template>

<script>

</script>
<script>
export default {
    props: ['id','with_opacity','with_spinner'],
    data() {
        return {
            nextElement: null,
            parentElement: null,
        }
    },
    computed:{
      opacity:function(){
          if(this.with_opacity === true || this.with_opacity === undefined){
              return true;
          }
          return false;
      },
        spinner:function(){
            if(this.with_spinner === true || this.with_spinner === undefined){
                return true;
            }
            return false;
        }
    },
    mounted() {
        let loader = this.$el;
        this.nextElement = loader.nextSibling.nextSibling;
        this.parentElement = loader.parentElement;

        //DESABILITA OS INPUTS
        let inputs = $(this.parentElement).find('input,select');
        for (var i = 0, len = inputs.length; i < len; i++) {
            if(!$(inputs[i]).hasClass('ignore-loader')) $(inputs[i]).prop('disabled', 'true');

        }

        //DESABILITA OS BOTOES
        let buttons =  $(this.parentElement).find('button');
        for (var i = 0, len = buttons.length; i < len; i++) {
            if(!$(buttons[i]).hasClass('ignore-loader')) $(buttons[i]).prop('disabled', 'true');
        }
        if(this.opacity){
            this.nextElement.classList.add("opacity-25");
            this.parentElement.classList.add("position-relative");
        }

    },
    beforeDestroy() {
        //HABILITA OS INPUTS
        let inputs =  $(this.parentElement).find('input,select');
        for (var i = 0, len = inputs.length; i < len; i++) {
            if(!$(inputs[i]).hasClass('ignore-loader')) $(inputs[i]).removeAttr('disabled');
        }

        //HABILITA OS BOTOES
        let buttons =  $(this.parentElement).find('button');
        for (var i = 0, len = buttons.length; i < len; i++) {
            if(!$(buttons[i]).hasClass('ignore-loader')) $(buttons[i]).removeAttr('disabled');
        }

        if(this.opacity){
            this.nextElement.classList.remove("opacity-25");
            this.parentElement.classList.remove("position-relative");
        }

        this.$parent.$forceUpdate();
    }
}
</script>
<style scoped>
.loader-helper div {
    margin: auto;
    left: 0;
    right: 0;
    top: 0;
    bottom: 0;
    position: absolute;
    padding: 0px !important;
    z-index: 9999;
}

.loader-helper .slot {
    top: 52% !important;
    text-align: center;
}

</style>
