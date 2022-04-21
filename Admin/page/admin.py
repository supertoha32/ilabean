from django.contrib import admin
from .models import *
class UserAdmin(admin.ModelAdmin):
    list_display = ('id', 'name','number', 'email','password', 'created_at','remember_token')
    list_display_links = ('id', 'name','email')
    search_fields = ('name',)
    list_filter = ('id','created_at')
class RequestAdmin(admin.ModelAdmin):
    list_display = ('id', 'status','category_id', 'description', 'price','created_at')
    list_display_links = ('id', 'price','category_id')
    search_fields = ('price', 'user_id')
    list_filter = ('id','created_at')
class MessageAdmin(admin.ModelAdmin):
    list_display = ('id', 'type','item_id', 'from_id', 'to_id','body','created_at')
    list_display_links = ('id', 'item_id',)
    search_fields = ('item_id',)
    list_filter = ('created_at',)


admin.site.register(User, UserAdmin)
admin.site.register(Request, RequestAdmin)
admin.site.register(Message, MessageAdmin)

