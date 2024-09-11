#!/usr/bin/python3
import discord
from discord.ext import commands
from discord import app_commands
import discord.ext
from dotenv import load_dotenv
import os
import asyncio
import geniApi

load_dotenv()

intents = discord.Intents.all()
intents.message_content = True
bot = discord.ext.commands.Bot(command_prefix="/", intents=intents)

clicked_users = []
shutdown_timer = None 

class MyView(discord.ui.View):
    @discord.ui.button(label="I was here!", style=discord.ButtonStyle.success)
    async def option1(self, interaction: discord.Interaction, button: discord.ui.Button):
        user_id = interaction.user.id            
        if user_id not in clicked_users:
                clicked_users.append(user_id)
        user_names = [interaction.client.get_user(user_id).name for user_id in clicked_users]
        await interaction.response.send_message(f"Clicked users: {', '.join(user_names)}", ephemeral=True)

async def shutdown_bot():
    print("girdi")
    await asyncio.sleep(3000)
    print("Api'ye istekler gönderildi")
    geniApi.geniApiPostAttendace(clicked_users) 
    await asyncio.sleep(100)
    print("kapanması lazım")  
    await bot.close() 

@bot.event
async def on_ready():
    print(f'Bot is ready. Logged in as {bot.user}')
    channel_id = 1262727636749123586  #1246043930693210112 
    channel = bot.get_channel(channel_id)
    if channel:
        developer_role_id = 1014167456224387092
        await channel.send(f"<@&{developer_role_id}> Günaydın Uyanma vakti. Burada olduğunuzu kanıtlamak için 5 dakikanız var!", view=MyView(timeout=3000))
    else:
        print("Channel not found")

    bot.loop.create_task(shutdown_bot())

bot.run(os.getenv('GENI_NOKER_BOT_TOKEN'))


