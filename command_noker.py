#!/usr/bin/python3
import discord
from discord.ext import commands
from discord import app_commands
import discord.ext
from dotenv import load_dotenv
import os
import geniApi
from datetime import datetime

load_dotenv()

intents = discord.Intents.all()
intents.message_content = True
bot = discord.ext.commands.Bot(command_prefix="/", intents=intents)
user_name_user_id = {
    1: "Mert İzal",
    3: "Özlem Kaya", 
    4: "Ömer Temel", 
    5: "Utku Özen",
    6: "Emre Arslan",
    7: "Berkay Öztunç", 
    8: "Alper Sendan" 
}
@bot.tree.command(name="get_attendace_by_id", description="Belirtilen tarihler arasında kullanıcının devamsızlık bilgisini getirir")
async def get_attendace_user_id(interaction:discord.Interaction, *, user_id: str, start_date: str, end_date: str):
    
    try:

        start = datetime.strptime(start_date, "%Y-%m-%d")
        end = datetime.strptime(end_date, "%Y-%m-%d")
        
        if start > end:
            await interaction.response.send_message("Başlangıç tarihi bitiş tarihinden önce olmalıdır.", ephemeral=True)

        rsp = geniApi.geni_get_attendace_by_id(user_id,start_date,end_date)
        response_json = rsp.json()
        data_list = response_json.get("data", [])
        user_genis_id = data_list[0].get('user_genis_id')
        embed=discord.Embed(title="Geni-Nöker", description=f"{user_name_user_id.get(user_genis_id)} adlı kullanıcının devamsızlık kayıtları", color=0xc73f05)
        #embed.set_thumbnail(url="https://pbs.twimg.com/profile_images/1734536862386003969/HF8UkH9Z_400x400.jpg")
        #embed.video(url="https://media1.tenor.com/m/rh_zTG2pMksAAAAC/good-morning-wake-up.gif")
        for data in data_list:
            embed.add_field(name=f"{data.get('date')}", value=f"{data.get('status')}", inline=False)
        embed.set_footer(text="developed by Geniousoft")
        await interaction.response.send_message(embed=embed, ephemeral=False)

    except ValueError:
        await interaction.response.send_message("Lütfen tarihleri 'YYYY-MM-DD' formatında giriniz.", ephemeral=True)



@bot.event
async def on_ready():
    print(f'We have logged in as {bot.user}')
    try:
        synced = await bot.tree.sync()
        print(f'Synced {len(synced)} command(s)')
    except Exception as e:
        print(f'Error syncing commands: {e}')

bot.run(os.getenv('GENI_NOKER_BOT_TOKEN'))