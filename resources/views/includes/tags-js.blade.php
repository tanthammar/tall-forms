<script>
{{-- used by Tags and TagsSearch --}}
    document.addEventListener('alpine:init', () => {
        Alpine.data('tags', (config) => ({
            searchInput: config.searchInput,
            tags: config.tags,
            open: config.open,
            addTag() {
                this.searchInput = this.searchInput.trim()
                if (this.searchInput === '' || this.tags.includes(this.searchInput)) {
                    this.clearInput()
                    return
                }
                this.tags.push(this.searchInput)
                this.clearInput()
            },
            deleteTag(tagToDelete, refresh = false) {
                this.tags.splice(this.tags.indexOf(tagToDelete), 1)
                if(refresh) Alpine.debounce(() => this.$wire.call('$refresh'), 250) {{-- update errorBag --}}
            },
            clearInput() {
                this.searchInput = ''
                this.open = false
            },
            {{-- TagsSearch only --}}
            addExistingTag(tag)
            {
                if (this.tags.includes(tag)) {
                    {{-- don't this.clearInput(), keep showing search result--}}
                    return
                }
                this.tags.push(tag)
                this.clearInput()
            }
        }))
    })
</script>
