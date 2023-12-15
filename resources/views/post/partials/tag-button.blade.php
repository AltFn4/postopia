<button type="button" @click="select({{ $tag->id }})" style="background-color: {{ $tag->colour }}" :class="{'opacity-100 border border-white border-2': tag_ids.includes({{ $tag->id }}), 'opacity-25': ! tag_ids.includes({{ $tag->id }})}" class="text-sm text-center rounded-lg shadow">
    {{ $tag->name }}
</button>