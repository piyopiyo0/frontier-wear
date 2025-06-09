How to use plugin Pilotwfc.blogviews / pilot@ua.fm /

1. Copy plugin to p;ugins/pilotwfc

2. Add 
views:
                tab: Manage
                label: Views
                type: number
                default: 0
                readonly: true
                span: left
To groups:
    regular_post:
        name: Regular Post

3. Add
views:
                tab: Manage
                label: Views
                type: number
                default: 0
                readonly: true
                span: left
to markdown_post:
        name: Markdown Post
        fields:
4. Save & Migrate

5. Insert {{ viewCounter.post.views }} to place counter

6. Enjoy!