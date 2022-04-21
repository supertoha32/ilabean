from django.db import models
# Create your models here.
from django.urls import reverse


class User(models.Model):
    name = models.CharField(max_length=255, verbose_name='Имя')
    number = models.IntegerField(verbose_name='Номер телефона')
    email = models.CharField(max_length=255, verbose_name='Почта')
    TIN = models.CharField(max_length=255, verbose_name='Идентификационный номер налогоплательщика')
    password = models.CharField(max_length=255, verbose_name='Пароль')
    remember_token = models.CharField(max_length=255,null=True, verbose_name='Ключ')
    created_at = models.DateTimeField(auto_now_add=True,null=True, verbose_name='Дата создания')
    updated_at = models.DateTimeField(auto_now=True,null=True, verbose_name='Дата последнего обновления')
    def __str__(self):
        return self.name
    class Meta:
        verbose_name = 'Пользователя'
        verbose_name_plural = 'Пользователи'

class Request(models.Model):
    status = models.CharField(max_length=255,null=True,verbose_name='Статус')
    type = models.CharField(max_length=255,null=True, verbose_name='Тип')
    category_id = models.BigIntegerField(null=True,verbose_name="id Категории")
    user_id = models.BigIntegerField(null=True,verbose_name="id Пользователя")
    description = models.TextField(null=True,verbose_name="Описание")
    price = models.FloatField(verbose_name="Цена")
    currency = models.CharField(max_length=255,null=True, verbose_name="Валюта")
    amount = models.IntegerField(verbose_name='Количество')
    city = models.CharField(max_length=255,null=True,verbose_name='Город')
    end_time = models.DateField(null=True,verbose_name='Завершение')
    created_at = models.DateTimeField(auto_now_add=True,null=True,verbose_name='Дата создания')
    updated_at = models.DateTimeField(auto_now=True,null=True,verbose_name='Дата последнего обновления')
    def __str__(self):
        return self.content
    class Meta:
        verbose_name = 'Запрос'
        verbose_name_plural = 'Запросы'
class Message(models.Model):
    type = models.CharField(max_length=255,null=True, verbose_name='Тип')
    from_id = models.BigIntegerField(null=True, verbose_name="id отправителя")
    to_id = models.BigIntegerField(null=True,verbose_name='id получателя')
    item_id = models.BigIntegerField(null=True, verbose_name='id Заказа')
    body = models.CharField(max_length=5000,null=True, verbose_name='Текст сообщения')
    seen = models.IntegerField(null=True,verbose_name='Видимость')
    created_at = models.DateTimeField(auto_now_add=True,null=True,verbose_name='Дата создания')
    updated_at = models.DateTimeField(auto_now=True,null=True,verbose_name='Дата последнего обновления')
    class Meta:
        verbose_name = 'Сообщению'
        verbose_name_plural = 'Сообщения'


