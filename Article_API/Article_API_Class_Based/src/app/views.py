from django.shortcuts import render, get_object_or_404, redirect
from app.models import Article, Articleform
from app.serializers import ArticleSerializer
from django.http import HttpResponse, JsonResponse
from rest_framework.parsers import JSONParser
from django.views.decorators.csrf import csrf_exempt
from rest_framework import status
from rest_framework.decorators import api_view
from rest_framework.response import Response
from rest_framework.views import APIView
# Create your views here.
from rest_framework.renderers import TemplateHTMLRenderer
from rest_framework.authentication import SessionAuthentication, BasicAuthentication, TokenAuthentication
from rest_framework.permissions import IsAuthenticated
from rest_framework import mixins
from rest_framework import generics
from rest_framework import viewsets
from django.shortcuts import render


class Articlelist(APIView):
    def get(self,request):
        arti = Article.objects.all()
        serializer = ArticleSerializer(arti, many=True)
        """context = { 
               "data_view" : []
               
        }
        context["data_view"].append({"response": serializer.data})
        return render(request, "app/home.html",context)"""
        return Response(serializer.data)
        
    def post(self,request):
        serializer = ArticleSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)


class ArticleDetails(APIView):

    def get_object(self,id):
        try:
            return get_object_or_404(Article,id=id)
        except Article.DoesNotExist:
            return Response(status=status.HTTP_404_NOT_FOUND)
    
    def get(self,request,id):
        article = self.get_object(id)
        serializer = ArticleSerializer(article)
        return Response(serializer.data)
    
    def put(self,request,id):
        article = self.get_object(id)
        serializer = ArticleSerializer(article,data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
    
    def delete (self,request,id):
        article = self.get_object(id)
        article.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)
        
        










































"""
@api_view(['GET', 'POST'])
def articlelist(request):
    if request.method == 'GET':
        arti = Article.objects.all()
        serializer = ArticleSerializer(arti, many=True)
        return Response(serializer.data)
    elif request.method == 'POST':
        serializer = ArticleSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)

@api_view(['GET', 'PUT', 'DELETE'])
def articledetails(request,pk):
    try:
        arti = Article.objects.get(id=pk)
    except arti.DoesNotExist:
        return Response(status=status.HTTP_404_NOT_FOUND)
    
    if request.method == 'GET':
        serializer = ArticleSerializer(arti)
        return Response(serializer.data)
    elif request.method == 'PUT':
        ArticleSerializer(data=request.data)
        serializer = ArticleSerializer(arti,data=data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)
    elif request.method == 'DELETE':
        arti.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)
"""