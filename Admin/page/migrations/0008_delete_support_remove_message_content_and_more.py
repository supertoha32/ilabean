# Generated by Django 4.0.4 on 2022-04-21 01:54

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('page', '0007_alter_request_options'),
    ]

    operations = [
        migrations.DeleteModel(
            name='Support',
        ),
        migrations.RemoveField(
            model_name='message',
            name='content',
        ),
        migrations.RemoveField(
            model_name='message',
            name='host',
        ),
        migrations.RemoveField(
            model_name='message',
            name='sender',
        ),
        migrations.RemoveField(
            model_name='message',
            name='time',
        ),
        migrations.RemoveField(
            model_name='request',
            name='cat',
        ),
        migrations.RemoveField(
            model_name='request',
            name='content',
        ),
        migrations.RemoveField(
            model_name='request',
            name='cur',
        ),
        migrations.RemoveField(
            model_name='request',
            name='end_date',
        ),
        migrations.RemoveField(
            model_name='request',
            name='start_date',
        ),
        migrations.RemoveField(
            model_name='request',
            name='user',
        ),
        migrations.AddField(
            model_name='message',
            name='body',
            field=models.CharField(max_length=5000, null=True, verbose_name='Текст сообщения'),
        ),
        migrations.AddField(
            model_name='message',
            name='created_at',
            field=models.DateTimeField(auto_now_add=True, null=True, verbose_name='Дата создания'),
        ),
        migrations.AddField(
            model_name='message',
            name='from_id',
            field=models.BigIntegerField(null=True, verbose_name='id отправителя'),
        ),
        migrations.AddField(
            model_name='message',
            name='item_id',
            field=models.BigIntegerField(null=True, verbose_name='id Заказа'),
        ),
        migrations.AddField(
            model_name='message',
            name='seen',
            field=models.IntegerField(null=True, verbose_name='Видимость'),
        ),
        migrations.AddField(
            model_name='message',
            name='to_id',
            field=models.BigIntegerField(null=True, verbose_name='id получателя'),
        ),
        migrations.AddField(
            model_name='message',
            name='type',
            field=models.CharField(max_length=255, null=True, verbose_name='Тип'),
        ),
        migrations.AddField(
            model_name='message',
            name='updated_at',
            field=models.DateTimeField(auto_now=True, null=True, verbose_name='Дата последнего обновления'),
        ),
        migrations.AddField(
            model_name='request',
            name='category_id',
            field=models.BigIntegerField(null=True, verbose_name='id Категории'),
        ),
        migrations.AddField(
            model_name='request',
            name='city',
            field=models.CharField(max_length=255, null=True, verbose_name='Город'),
        ),
        migrations.AddField(
            model_name='request',
            name='created_at',
            field=models.DateTimeField(auto_now_add=True, null=True, verbose_name='Дата создания'),
        ),
        migrations.AddField(
            model_name='request',
            name='currency',
            field=models.CharField(max_length=255, null=True, verbose_name='Валюта'),
        ),
        migrations.AddField(
            model_name='request',
            name='description',
            field=models.TextField(null=True, verbose_name='Описание'),
        ),
        migrations.AddField(
            model_name='request',
            name='end_time',
            field=models.DateField(null=True, verbose_name='Завершение'),
        ),
        migrations.AddField(
            model_name='request',
            name='status',
            field=models.CharField(max_length=255, null=True, verbose_name='Статус'),
        ),
        migrations.AddField(
            model_name='request',
            name='type',
            field=models.CharField(max_length=255, null=True, verbose_name='Тип'),
        ),
        migrations.AddField(
            model_name='request',
            name='updated_at',
            field=models.DateTimeField(auto_now=True, null=True, verbose_name='Дата последнего обновления'),
        ),
        migrations.AddField(
            model_name='request',
            name='user_id',
            field=models.BigIntegerField(null=True, verbose_name='id Пользователя'),
        ),
        migrations.AlterField(
            model_name='request',
            name='amount',
            field=models.IntegerField(verbose_name='Количество'),
        ),
        migrations.AlterField(
            model_name='request',
            name='price',
            field=models.FloatField(verbose_name='Цена'),
        ),
        migrations.AlterField(
            model_name='user',
            name='created_at',
            field=models.DateTimeField(auto_now_add=True, null=True, verbose_name='Дата создания'),
        ),
        migrations.AlterField(
            model_name='user',
            name='remember_token',
            field=models.CharField(max_length=255, null=True, verbose_name='Ключ'),
        ),
        migrations.AlterField(
            model_name='user',
            name='updated_at',
            field=models.DateTimeField(auto_now=True, null=True, verbose_name='Дата последнего обновления'),
        ),
    ]