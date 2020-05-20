@auth
<div x-data="{
        expression: '',
        cancel() { this.expression = ''; },
        backspace() {
            const exp = this.expression;
            this.expression = Array.from(exp).slice(0, exp.length-1).join('');
        },
        negative() {
            const exp = this.expression;
            if (exp.charAt(exp.length-1) == '-') { this.backspace() } else { this.expression += '-' };
        },
        evaluate() { return this.expression.length > 0 ? eval(this.expression) : '' },
        equal() { this.expression = this.evaluate() }
     }"
     id="calc"
     class="border rounded fixed bottom-0 right-0 mb-16 mr-2 shadow pb-2 hidden"
     style="width: 200px">

    <!-- Cabecera -->
    <header>
        <div class="flex justify-end p-2">
            <div @click="document.querySelector('#calc').classList.toggle('hidden')"
                 class="cursor-pointer">
                <span class="iconify"
                      data-icon="ic:baseline-close"
                      data-inline="false">
                </span>
            </div>
        </div>
    </header>

    <!-- Diplay -->
    <div class="border-t-2 border-b-2 border-gray-200"
         style="min-height: 58px; overflow-wrap: anywhere;">
        <div x-ref="display" x-html="expression" class="w-full px-2 text-2xl text-right"></div>
        <div x-ref="result" x-html="evaluate()" class="text-xs text-gray-600 text-right px-2"></div>
    </div>

    <!-- Comandos helpers -->
    <div class="flex justify-end px-2 my-1">

        <div @click="backspace">
            <span class="iconify cursor-pointer text-blue-800"
                 data-icon="ic:outline-backspace"
                 data-inline="false">
            </span>
        </div>

    </div>


    <!-- Botones -->
    <div class="flex mt-1">
        @php $parOpen='('; $parClose=')'; @endphp
        <div class="w-3/4 flex flex-wrap">
            <x-calc.button class="text-red-500" :width="'w-1/3'" :content="'C'" :action="'cancel'"/>
            <x-calc.button :width="'w-1/3'" :content="$parOpen"/>
            <x-calc.button :width="'w-1/3'" :content="$parClose"/>
            @foreach(range(1,9) as $num)
                <x-calc.button :width="'w-1/3'" :content="$num"/>
            @endforeach
            <x-calc.button :width="'w-1/3'" :content="'+/-'" :action="'negative'"/>
            <x-calc.button :width="'w-1/3'" :content="'0'"/>
            <x-calc.button :width="'w-1/3'" :content="'.'"/>
        </div>

        <div class="w-1/4">
            <x-calc.button class="text-blue-500" :content="'/'"/>
            <x-calc.button class="text-blue-500" :content="'*'"/>
            <x-calc.button class="text-blue-500" :content="'+'"/>
            <x-calc.button class="text-blue-500" :content="'-'"/>
            <x-calc.button class="text-gray-200 bg-blue-500" :content="'='" :action="'equal'"/>
        </div>
    </div>

</div>
@endauth
